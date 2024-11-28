<?php

namespace App\Http\Controllers;

use App\Http\Validators\AddressValidator;
use App\Http\Validators\CartValidator;
use App\Http\Validators\PaymentValidator;
use App\Services\ProductItemService;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Color;
use App\Models\DeliveryService;
use App\Models\Province;
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
        $this->mpAccessToken = config('app.mp_access_token');
        MercadoPagoConfig::setAccessToken($this->mpAccessToken);
        $this->shippingService = new ShippingService();
        $this->productItemService = new ProductItemService();
        $this->checkoutService = new CheckoutService();
    }
    public function showCheckoutDeliveryPage(Request $request)
    {
        try {
            $zipCode = ModelsZipCode::where('code', '=', $request->zip_code)->firstOrFail();
            $province = Province::where('name', '=', $request->province)->firstOrFail();
            $city = Province::findOrFail($request->city);
        } catch (\Throwable $th) {
            redirect()->route('cart');
        }
        $request->validate([
            'zip_code' => ['required'],
            'province' => ['required'],
            'city' => ['required']
        ]);
        $user = User::where('id', auth()->user()->id)->with('address')->first();
        return view('checkout.delivery', ['user' => $user, 'zip_code' => $request->zip_code, 'province' => $request->province, 'city' => $request->city, 'paymentMethod' => $request->paymentMethod]);
    }

    public function showCheckoutPaymentPage(Request $request)
    {
        $request->validate([
            'selectedMethod' => ['string', 'alpha', Rule::in(['domicilio', 'sucursal', 'retiro'])],
            'paymentMethod' => ['string', 'alpha', Rule::in(['mercado_pago', 'transferencia'])]
        ]);
        $paymentMethod = $request->paymentMethod;
        $sucursal = null;
        //MercadoPago initialization
        $mpAccessToken = MercadoPagoConfig::getAccessToken();
        $mpClientToken = config('app.mp_client_token');

        // User, address, and linked cart. Colors
        $user = User::where('id', auth()->user()->id)->with('address')->first();
        $cart = Cart::where('user_id', $user->id)->first();

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
        $colors = Color::all();
        if ($cart == null) {
            return redirect('/')->with('error', 'Invalid Data');
        }
        $orderService = new OrderService();
        $shippingService = new ShippingService();
        switch ($request->selectedMethod) {
            case 'domicilio':
                $address = null;
                if ($request->address_id) {
                    $address = $user->addresses->find($request->address_id);
                }
                if ($address == null) {
                    $address = $user->addresses->first();
                }
                if ($address == null) {
                    return redirect('/cart')->with('error', 'Invalid Data');
                }
                $address->load('zipCode', 'city', 'province');
                $deliveryService = DeliveryService::where('name', '=', 'oca')->first();
                $shippingCosts = $this->shippingService->getShippingCosts($address, config('app.delivery_service.sucursal_a_puerta'));
                if ($paymentMethod == 'transferencia') {
                    $order = $orderService->createDeliveryOrder(null, $user, $address, (float)$shippingCosts, false);
                    return redirect()->route('orders.show', ['id' => $order->id]);
                }
                break;
            case 'sucursal':
                $address = null;
                $sucursal = $request->sucursal;
                $deliveryService = DeliveryService::where('name', '=', 'oca')->first();
                $shippingCosts = $this->shippingService->getShippingCosts($sucursal['CodigoPostal'], config('app.delivery_service.sucursal_a_sucursal'));
                if ($paymentMethod == 'transferencia') {
                    $sucursalesCollection = collect($shippingService->getSucursales($sucursal['CodigoPostal']));
                    $sucursal = $sucursalesCollection->firstWhere('IdCentroImposicion', '=', $sucursal['IdCentroImposicion']);
                    $order = $orderService->createSucursalOrder(null, $user, $sucursal, (float)$shippingCosts, false);
                    return redirect()->route('orders.show', ['id' => $order->id]);
                }
                break;
            case 'retiro':
                if ($paymentMethod == 'transferencia') {
                    $order = $orderService->createRetiroOrder(null, $user, false);
                    return redirect()->route('orders.show', ['id' => $order->id]);
                }
                $admin = User::where('name', '=', 'Ethereal')->first();
                $rinoZipCode = ModelsZipCode::where('code', '=', '3400')->first();
                $rinoProvince = $rinoZipCode->province;
                $address = Address::firstOrCreate(['name' => 'rino'], ['user_id' => $admin->id, 'last_name' => 'indumentaria', 'phone_number' => '379 4316606', 'zip_code_id' => $rinoZipCode->id, 'province_id' => $rinoProvince->id, 'address' => 'Milan 1201', 'street' => 'Milan', 'number' => '1201']);
                $deliveryService = DeliveryService::where('name', '=', 'Retiro en el Local')->first();
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
        $selectedMethod = $request->selectedMethod;

        // MercadoPago Client and Preference initialization
        $client = new PreferenceClient();
        try {
            $preference = $client->create([
                "items" => $items,
                "binary_mode" => true,
                "shipments" => [
                    "cost" => $shippingCosts
                ],
                "back_urls" => [
                    "success" => "{$appUrl}/payment/handle?payment_method={$selectedMethod}",
                    "failure" => "{$appUrl}/payment/failure",
                    "pending" => "{$appUrl}/payment/failure"
                ],
                "auto_return" => "approved",
            ]);
        }
        catch (MPApiException $e) {
            dd($e, $items);
        }


        return view('checkout.payment', ['cart' => $cart, 'pref' => $preference, 'items' => $items, 'colors' => $colors, 'address' => $address, 'cartItems' => $cartItems, 'shippingCosts' => $shippingCosts, 'total' => $total, 'cartTotal' => $cartTotal, 'clientToken' => $mpClientToken, 'delivery_service' => $deliveryService, 'sucursal' => $sucursal, 'selectedMethod' => $selectedMethod]);
    }
    public function validateAddressAndSaveToDatabase(Request $request)
    {
        $validator = new AddressValidator;
        $addressService = new AddressService();
        $validatedFields = $validator->validateRequest($request);
        $address = $addressService->saveOrUpdate($validatedFields, User::find($request->user_id));
        if ($request->paymentMethod) {
            $request->validate([
                'paymentMethod' => [Rule::in(['mercado_pago', 'transferencia'])],
            ]);
        }
        return redirect()->route('checkout.payment', ['address_id' => $address->id, 'selectedMethod' => $request->selectedMethod, 'paymentMethod' => $request->paymentMethod]);
    }

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
                "binary_mode" => true,
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

        if ($payment->status != "approved") {
            return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
        }
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

        $order = null;

        switch ($request->selectedMethod) {
            case 'domicilio':
                $request->validate([
                    'address_id' => 'nullable|exists:addresses,id',
                ]);
                $order = $orderService->createDeliveryOrder($payment, $user, Address::find($request->address_id), (float)$request->delivery_price);
                break;
            case 'sucursal':
                $sucursalesIds = $shippingService->getSucursalesIds($request->zip_code);
                $sucursalesCollection = collect($shippingService->getSucursales($request->zip_code));
                $sucursal = $sucursalesCollection->firstWhere('IdCentroImposicion', '=', $request->sucursal);
                $request->validate([
                        'sucursal' => ['nullable', 'numeric', Rule::in($sucursalesIds)]
                    ]);
                $order = $orderService->createSucursalOrder($payment, $user, $sucursal, (float)$request->delivery_price);
                break;
                case 'retiro':
                    $order = $orderService->createRetiroOrder($payment, $user, (float)$request->delivery_price);
                    break;
        }


        return redirect()->route('orders.show', ['id' => $order->id]);
    }
    public function handleMercadoPagoPayment(Request $request)
    {
        $shippingService = new ShippingService();
        $orderService = new OrderService();

        $request->validate([
            'payment_id' => 'required',
            'selectedMethod' => 'required|in:domicilio,sucursal,retiro',
            'delivery_price' => 'nullable|numeric',
        ]);

        $user = Auth::user();
        $items = $user->cart->contents;

        $client = new PaymentClient();
        $id = $request->payment_id;
        $payment = $client->get($id);

        if ($payment->status != "approved") {
            return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
        }
        $order = null;

        switch ($request->selectedMethod) {
            case 'domicilio':
                $request->validate([
                    'address_id' => 'nullable|exists:addresses,id',
                ]);
                $order = $orderService->createDeliveryOrder($payment, $user, Address::find($request->address_id), (float)$request->delivery_price);
                break;
            case 'sucursal':
                $sucursalesIds = $shippingService->getSucursalesIds($request->zip_code);
                $sucursalesCollection = collect($shippingService->getSucursales($request->zip_code));
                $sucursal = $sucursalesCollection->firstWhere('IdCentroImposicion', '=', $request->sucursal);
                $request->validate([
                        'sucursal' => ['nullable', 'numeric', Rule::in($sucursalesIds)]
                    ]);
                $order = $orderService->createSucursalOrder($payment, $user, $sucursal, (float)$request->delivery_price);
                break;
                case 'retiro':
                    $order = $orderService->createRetiroOrder($payment, $user, (float)$request->delivery_price);
                    break;
        }


        return redirect()->route('orders.show', ['id' => $order->id]);
    }
    public function showPaymentFailure(Request $request)
    {
        $client = new PaymentClient();
        $id = $request->payment_id;
        $payment = $client->get($id);

        $paymentJson = json_encode($payment);
        return view('checkout.payment_failure', compact('paymentJson', 'payment'));
    }
}
