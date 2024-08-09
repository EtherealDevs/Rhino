<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\ZipCode as ModelsZipCode;
use App\Rules\ZipCode;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showCheckoutDeliveryPage()
    {
        $user = User::where('id', auth()->user()->id)->with('address')->first();
        return view('checkout.delivery', ['user' => $user]);
    }
    public function showCheckoutPaymentPage()
    {
        dd(auth()->user());
        return view('checkout.payment');
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
            'province_id' => Province::where('id', $validatedFields['province'])->first()->id,
            'city_id' => City::where('id', $validatedFields['city'])->first()->id,
            'address' => $validatedFields['address'],
            'street' => $validatedFields['street'],
            'number' => $validatedFields['number'],
            'department' => $validatedFields['department'],
            'street1' => $validatedFields['street1'],
            'street2' => $validatedFields['street2'],
            'observation' => $validatedFields['observation'],
        ];
        $address = Address::updateOrCreate(
            ['user_id' => $request->user_id],
            $fields
        );
    }
}
