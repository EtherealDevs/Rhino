<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Client\Payment\PaymentClient;
use Illuminate\Support\Facades\Log;
use MercadoPago\Resources\Payment;

class WebhookService {

    public function handleWebhookOrders($paymentId, $data)
    {
        Log::channel('webhook')->info('Creating Order', ['paymentId' => $paymentId, 'data' => $data]);
        $shippingService = new ShippingService();
        $orderService = new OrderService();
    
    
            $user = Auth::user();
    
            $client = new PaymentClient();
            $id = $paymentId;
            try {
                $payment = $client->get($id);
            } catch (\MercadoPago\Exceptions\MPApiException $th) {
                Log::channel('webhook')->error('Error getting payment from MP API', ['payment_id' => $paymentId, 'error' => json_decode($th)]);
                dd($th);
            }
    
            Log::channel('webhook')->info('Get payment from MP API', ['payment' => $payment, 'user' => $user]);
            if ($payment->status != "approved") {
                Log::channel('webhook')->info('Payment status is not "approved" ', ['payment' => $payment, 'payment_status' => $payment->status]);
                return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
            }
            if (Order::where('mp_order_id', '=', $payment->id)->exists()) {
                Log::channel('webhook')->info('Payment already exists', ['payment' => $payment, 'order_id' => Order::where('mp_order_id', '=', $payment->id)->first()->id ]);
                return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
            }
            $order = null;
    
            // Wallet|other - address ID - Sucursal IdCentroImposicion - Sucursal CodigoPostal
            $dataArray = explode('-', $payment->external_reference);
            $wallet = $dataArray[0];
            $addressId = $dataArray[1];
            $sucursalId = $dataArray[2];
            $zipCode = $dataArray[3];

            Log::channel('webhook')->info('Turning data from external_reference into array', ['data_array' => $dataArray, 'wallet' => $wallet, 'address_id' => $addressId, 'sucursal_id' => $sucursalId, 'zip_code' => $zipCode]);

            $selectedMethod = null;

            if ($wallet != "wallet") {
                Log::channel('webhook')->info('Payment is not coming from "wallet" ', ['wallet' => $wallet]);
                return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
            }
            if ($addressId != null) {
                Log::channel('webhook')->info('AddressId is not null', ['address_id' => $addressId]);
                $address = Address::find($addressId);
                if ($address == null) {
                    Log::channel('webhook')->info('Address model is null', ['adress' => $address]);
                    return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
                }
                if ($address->name === "rino" && $address->user_id === 12)
                {
                    Log::channel('webhook')->info('Address name is Rino, and user_id is 12', ['address' => $address]);
                    $selectedMethod = "retiro";
                }
                else {
                    Log::channel('webhook')->info('Address is not null, is not rino, and user_id is not 12', ['address' => $address]);
                    $selectedMethod = "domicilio";
                }
            }
            else {
                if ($addressId == null && $sucursalId != null) {
                    Log::channel('webhook')->info('AddressId is null and sucursalId is not null', ['address_id' => $addressId, 'sucursalId' => $sucursalId]);
                    $selectedMethod = "sucursal";
                    $sucursalesIds = $shippingService->getSucursalesIds($zipCode);
                        $sucursalesCollection = collect($shippingService->getSucursales($zipCode));
                        $sucursal = $sucursalesCollection->firstWhere('IdCentroImposicion', '=', $sucursalId);
                        if ($sucursal == null) {
                            Log::channel('webhook')->info('Sucursal is null', ['sucursal' => $sucursal]);
                            return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
                        }
                }
            }

            switch ($selectedMethod) {
                case 'domicilio':
                    Log::channel('webhook')->info('SelectedMethod is domicilio', ['selectedMethod' => $selectedMethod, 'payment' => $payment, 'user' => $user, 'address' => $address, 'shipping_amount' => $payment->shipping_amount]);
                    $order = $orderService->createDeliveryOrder($payment, $user, $address, (float)$payment->shipping_amount);
                    break;
                case 'sucursal':
                    Log::channel('webhook')->info('SelectedMethod is sucursal', ['selectedMethod' => $selectedMethod, 'payment' => $payment, 'user' => $user, 'sucursal' => $sucursal, 'shipping_amount' => $payment->shipping_amount]);
                    $order = $orderService->createSucursalOrder($payment, $user, $sucursal, (float)$payment->shipping_amount);
                    break;
                    case 'retiro':
                        Log::channel('webhook')->info('SelectedMethod is domicilio', ['selectedMethod' => $selectedMethod, 'payment' => $payment, 'user' => $user, 'address' => $address, 'shipping_amount' => $payment->shipping_amount]);
                        $order = $orderService->createRetiroOrder($payment, $user);
                        break;
            }
            return $order;
        }
}
