<?php

namespace App\Http\Controllers;

use App\Http\Cart\CartCombo;
use App\Http\Cart\CartItem;
use App\Http\Validators\AddressValidator;
use App\Http\Validators\CartValidator;
use App\Http\Validators\PaymentValidator;
use App\Services\ProductItemService;
use App\Models\Address;
use App\Models\Cart;
use App\Models\City;
use App\Models\Color;
use App\Models\DeliveryService;
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
use Illuminate\Validation\Rule;
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
    public function showCheckoutDeliveryPage(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->with('address')->first();
        return view('checkout.delivery', ['user' => $user, 'zip_code' => $request->zip_code, 'province' => $request->province, 'city' => $request->city]);
    }

    public function showCheckoutPaymentPage(Request $request)
    {
        $request->validate([
            'selectedMethod' => ['string', 'alpha', Rule::in(['domicilio', 'sucursal', 'retiro'])]
        ]);
        $sucursal = null;
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
        switch ($request->selectedMethod) {
            case 'domicilio':
                $address = null;
                if ($request->address_id) {
                    $address = $user->addresses->find($request->address_id);
                }
                if ($address == null) {
                    $address = $user->addresses->first();
                }
                $address->load('zipCode', 'city', 'province');
                $deliveryService = DeliveryService::where('name', '=', 'oca')->first();
                $shippingCosts = $this->shippingService->getShippingCosts($address, config('app.delivery_service.sucursal_a_puerta'));
                break;
            case 'sucursal':
                $address = null;
                $sucursal = $request->sucursal;
                dd($sucursal);
                $shippingCosts = $this->shippingService->getShippingCosts($sucursal['IdCentroImposicion'], config('app.delivery_service.sucursal_a_sucursal'));
                break;
            case 'retiro':
                $address = null;
                $sucursal = null;
                $shippingCosts = 0;
                break;
            default:
                # code...
                break;
        }


        // Cart contents
        $cartContents = json_decode($cart->contents, true);
        $cart->contents = $cartContents;

        // Checkout items
        $arrayWithItems = $this->checkoutService->buildItems($cart);
        $items = $arrayWithItems[0];
        $cartItems = $arrayWithItems[1];


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
        $selectedMethod = $request->selectedMethod;

        return view('checkout.payment', ['cart' => $cart, 'pref' => $preference, 'items' => $items, 'colors' => $colors, 'address' => $address, 'cartItems' => $cartItems, 'shippingCosts' => $shippingCosts, 'total' => $total, 'cartTotal' => $cartTotal, 'clientToken' => $mpClientToken, 'delivery_service' => $deliveryService, 'sucursal' => $sucursal, 'selectedMethod' => $selectedMethod]);
    }
    public function validateAddressAndSaveToDatabase(Request $request)
    {
        $validator = new AddressValidator;
        $addressService = new AddressService();
        $validatedFields = $validator->validateRequest($request);
        $address = $addressService->saveOrUpdate($validatedFields, User::find($request->user_id));

        return redirect()->route('checkout.payment', ['address_id' => $address->id, 'selectedMethod' => $request->selectedMethod]);
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
        $user = Auth::user();
        $cartValidator = new CartValidator($user->cart);
        $redirect = $cartValidator->validateCart();

        if ($redirect) {
                // Set session flash message
                session()->flash('cartError', 'Se eliminaron del carrito algunos productos que ya no estaban disponibles.');
                // Return a JSON response with the redirect URL
                return response()->json([
                    'status' => 'error',
                    'redirect_url' => route('cart'),
                    'message' => 'Se eliminaron del carrito algunos productos que ya no estaban disponibles.'
                ], 400);
        }

        $client = new PaymentClient();



        try {
            $payment = $client->create([
                "transaction_amount" => $request->transaction_amount,
                "token" => $request->token,
                "installments" => $request->installments,
                "payment_method_id" => $request->payment_method_id,
                "issuer_id" => $request->issuer,
                "additional_info" => [
                    "items" => $request->additional_info['items']
                ],
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
            // return redirect()->back()->withErrors($e, 'paymentError');
        }

        $array = json_decode(json_encode($payment), true);
        // $implode = implode("", $array);
        return $array;
    }
    public function handlePayment(Request $request)
    {
        $shippingService = new ShippingService();
        $orderService = new OrderService();

        $request->validate([
            'mp_order_id' => 'required',
            'selectedMethod' => 'required|in:domicilio,sucursal,retiro',
            'delivery_price' => 'nullable|numeric',
        ]);
        
        $user = Auth::user();
        $items = $user->cart->contents;

        $client = new PaymentClient();
        $id = $request->mp_order_id;
        $payment = $client->get($id);

        $order = null;

        switch ($request->selectedMethod) {
            case 'domicilio':
                $request->validate([
                    'address_id' => 'nullable|exists:addresses,id',
                ]);
                $order = $orderService->createDeliveryOrder($payment, $user, Address::find($request->address_id), (float)$request->delivery_price);
                break;
            case 'sucursal':
                $order = $sucursalesIds = $shippingService->getSucursalesIds($request->zip_code);
                $request->validate([
                        'sucursal' => ['nullable', 'numeric', Rule::in($sucursalesIds)]
                    ]);
                $orderService->createSucursalOrder($payment, $user, $request->sucursal, (float)$request->delivery_price);
                break;
            case 'retiro':
                $order = $orderService->createRetiroOrder($payment, $user, (float)$request->delivery_price);
                break;
        }


        return redirect()->route('orders.show', ['id' => $order->id]);
    }
}
