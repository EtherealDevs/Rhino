<?php

namespace App\Http\Controllers;

use App\Http\Cart\CartCombo;
use App\Http\Cart\CartItem;
use App\Http\Validators\AddressValidator;
use App\Http\Validators\PaymentValidator;
use App\Services\ProductItemService;
use App\Models\Address;
use App\Models\Cart;
use App\Models\City;
use App\Models\Color;
use App\Models\Order;
use App\Models\ProductItem;
use App\Models\ProductSize;
use App\Models\Province;
use App\Models\Size;
use App\Models\User;
use App\Models\ZipCode as ModelsZipCode;
use App\Rules\ZipCode;
use App\Services\AddressService;
use App\Services\CheckoutService;
use App\Services\OrderService;
use App\Services\ShippingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class CheckoutController extends Controller
{
    private $productItemService;
    private $shippingService;
    private $checkoutService;
    private $mpAccessToken;
    public function __construct()
    {
        $this->mpAccessToken = config('app.mp_access_token_test');
        MercadoPagoConfig::setAccessToken($this->mpAccessToken);
        $this->shippingService = new ShippingService();
        $this->productItemService = new ProductItemService();
        $this->checkoutService = new CheckoutService();
    }
    public function showCheckoutDeliveryPage()
    {
        $user = User::where('id', auth()->user()->id)->with('address')->first();
        return view('checkout.delivery', ['user' => $user]);
    }

    public function showCheckoutPaymentPage(Request $request)
    {
        //MercadoPago initialization
        $mpAccessToken = MercadoPagoConfig::getAccessToken();
        $mpClientToken = config('app.mp_client_token_test');

        // User, address, and linked cart. Colors
        $user = User::where('id', auth()->user()->id)->with('address')->first();
        $cart = Cart::where('user_id', $user->id)->first();
        $colors = Color::all();
        if ($cart == null || $user->addresses->isEmpty()) {
            return redirect('/')->with('error', 'Invalid Data');
        }
        $address = null;
        if ($request->address_id) {
            $address = $user->addresses->find($request->address_id);
        }
        if ($address == null) {
            $address = $user->addresses->first();
        }
        $address->load('zipCode', 'city', 'province');
        // Cart contents
        $cartContents = json_decode($cart->contents, true);
        $cart->contents = $cartContents;

        // Checkout items
        $arrayWithItems = $this->checkoutService->buildItems($cart);
        $items = $arrayWithItems[0];
        $cartItems = $arrayWithItems[1];
        
        // Total and shipping costs
        $shippingCosts = $this->shippingService->getShippingCosts($user->addresses[0]);
        $total = (float) ($cart->total / 100) + $shippingCosts;
        $cartTotal = (float) ($cart->total / 100);

        // Unknown
        $appUrl = config('app.url');

        // MercadoPago Client and Preference initialization
        $client = new PreferenceClient();
        $preference = $client->create([
            "items" => $items,
            "back_urls" => [
                "success" => "{$appUrl}/",
                "failure" => "{$appUrl}/payment_failure",
                "pending" => "{$appUrl}/payment_pending"
            ]
        ]);
        

        return view('checkout.payment', ['cart' => $cart, 'pref' => $preference, 'items' => $items, 'colors' => $colors, 'address' => $address, 'cartItems' => $cartItems, 'shippingCosts' => $shippingCosts, 'total' => $total, 'cartTotal' => $cartTotal, 'clientToken' => $mpClientToken, 'delivery_service_id' => $deliveryServiceId]);
    }
    public function validateAddressAndSaveToDatabase(Request $request)
    {
        dd($request);
        $validator = new AddressValidator;
        $addressService = new AddressService();
        $validatedFields = $validator->validateRequest($request);
        $address = $addressService->saveOrUpdate($validatedFields, User::find($request->user_id));

        return redirect()->route('checkout.payment', ['address_id' => $address->id]);
    }

    /**
     * Processes a payment using MercadoPago API.
     *
     * @param Request $request The request object containing payment details.
     *
     * @return array The payment response from MercadoPago API.
     *
     * @throws MPApiException If there is an error processing the payment.
     */
    public function processPayment(Request $request)
    {
        $validator = new PaymentValidator($request);
        $validator->validateRequest($request);

        $client = new PaymentClient();

        try {
            $payment = $client->create([
                "transaction_amount" => $request->transaction_amount,
                "token" => $request->token,
                "installments" => $request->installments,
                "payment_method_id" => $request->payment_method_id,
                "issuer_id" => $request->issuer,
                "payer" => [
                    "email" => $request->payer['email'],
                    "identification" => [
                        "type" => $request->payer['identification']['type'],
                        "number" => $request->payer['identification']['number']
                    ],
                ],
            ]);
        } catch (MPApiException $e) {
            dd($e);
        }

        $array = json_decode(json_encode($payment), true);
        // $implode = implode("", $array);
        return $array;
    }
    public function handlePayment($paymentId, Request $request)
    {
        $orderService = new OrderService();
        $user = Auth::user();
        $client = new PaymentClient();
        $id = $paymentId;
        $payment = $client->get($id);
        dd($payment, $payment->additional_info);
        $orderService->createOrder($payment, $user, Address::find($request->address_id));

        return view('checkout.payment_status', ['payment' => $paymentId]);
    }
}
