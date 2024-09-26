<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\City;
use App\Models\Color;
use App\Models\ProductItem;
use App\Models\Province;
use App\Models\Size;
use App\Models\User;
use App\Models\ZipCode as ModelsZipCode;
use App\Rules\ZipCode;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class CheckoutController extends Controller
{
    public function showCheckoutDeliveryPage()
    {
        $user = User::where('id', auth()->user()->id)->with('address')->first();
        return view('checkout.delivery', ['user' => $user]);
    }
    public function showCheckoutPaymentPage()
    {
        MercadoPagoConfig::setAccessToken('TEST-1863433352034000-081121-b3a2bd0c928b6a40cccfbf412ea5b6e5-1943115456');
        $mpAccessToken = MercadoPagoConfig::getAccessToken();

        $user = User::where('id', auth()->user()->id)->with('address')->first();
        $cart = Cart::where('user_id', $user->id)->first();

        $cartContents = json_decode($cart->contents, true);
        $cart->contents = $cartContents;
        $items = [];
        foreach ($cart->contents as $item) {
            $sizeModel = Size::where('name', $item['size'])->first();
            $itemModel = $sizeModel->items()->wherePivot('size_id', $sizeModel->id)->wherePivot('product_item_id', $item['item']['id'])->first();
            $newItem = [
                'id' => $itemModel->pivot->id,
                'title' => $itemModel->product->name,
                'category_id' => 'fashion',
                "currency_id" => "ARS",
                "picture_url" => "https://www.mercadopago.com/org-img/MP3/home/logomp3.gif",
                "description" => "Nombre: '{$itemModel->product->name}'. Color: '{$itemModel->color->name}'. Talle: '{$item['size']}'",
                "quantity" => $item['amount'],
                "unit_price" => $itemModel->price() / 100
            ];
            array_push($items, $newItem);
        };

        $appUrl = config('app.url');

        $client = new PreferenceClient();
        $preference = $client->create([
            "items" => $items,
            "back_urls" => [
                "success" => "{$appUrl}/",
                "failure" => "{$appUrl}/payment_failure",
                "pending" => "{$appUrl}/payment_pending"
            ]
        ]);

        return view('checkout.payment', ['cart' => $cart, 'pref' => $preference]);
    }
    public function validateAddressAndSaveToDatabase(Request $request)
    {
        $validatedFields = $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode],
            'province' => 'required',
            'city' => 'required',
            'address' => 'required|string',
            'street' => 'required|string',
            'number' => 'string|nullable',
            'department' => 'string|nullable',
            'street1' => 'string|nullable',
            'street2' => 'string|nullable',
            'observation' => 'string|nullable',
        ]);
        $fields = [
            'name' => $validatedFields['name'],
            'last_name' => $validatedFields['last_name'],
            'zip_code_id' => ModelsZipCode::where('code', '=', $validatedFields['zip_code'])->first()->id,
            'province_id' => Province::where('name', $validatedFields['province'])->first()->id,
            'city_id' => City::where('id', $validatedFields['city'])->first()->id,
            'address' => $validatedFields['address'],
            'street' => $validatedFields['street'],
            'number' => $validatedFields['number'],
            'department' => $validatedFields['department'],
            'street1' => $validatedFields['street1'],
            'street2' => $validatedFields['street2'],
            'observation' => $validatedFields['observation'] ?? null,   
        ];

        $address = Address::updateOrCreate(
            ['user_id' => $request->user_id],
            $fields
        );
        return redirect()->route('checkout.payment');
    }

    public function processPayment(Request $request)
    {
        return response($request, 200);
    }
}
