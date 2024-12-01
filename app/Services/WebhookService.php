<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Resources\Payment;

class WebhookService {

    public function handleWebhookOrders($paymentId, $data)
    {
        $shippingService = new ShippingService();
        $orderService = new OrderService();
    
    
            $user = Auth::user();
            $items = $user->cart->contents;
    
            $client = new PaymentClient();
            $id = $paymentId;
            $payment = $client->get($id);
    
            if ($payment->status != "approved") {
                return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
            }
            if (Order::where('mp_order_id', '=', $payment->id)->exists()) {
                return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
            }
            $order = null;
    
            // Wallet|other - address ID - Sucursal IdCentroImposicion - Sucursal CodigoPostal
            $dataArray = explode('-', $payment->external_reference);
            $wallet = $dataArray[0];
            $addressId = $dataArray[1];
            $sucursalId = $dataArray[2];
            $zipCode = $dataArray[3];

            $selectedMethod = null;

            if ($wallet != "wallet") {
                return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
            }
            if ($addressId != null) {
                $address = Address::find($addressId);
                if ($address == null) {
                    return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
                }
                if ($address->name === "rino" && $address->user_id === 12)
                {
                    $selectedMethod = "retiro";
                }
                else {
                    $selectedMethod = "domicilio";
                }
            }
            else {
                if ($addressId == null && $sucursalId != null) {
                    $selectedMethod = "sucursal";
                    $sucursalesIds = $shippingService->getSucursalesIds($zipCode);
                        $sucursalesCollection = collect($shippingService->getSucursales($zipCode));
                        $sucursal = $sucursalesCollection->firstWhere('IdCentroImposicion', '=', $sucursalId);
                        if ($sucursal == null) {
                            return redirect()->route('payment.failure', ['payment_id' => $payment->id]);
                        }
                }
            }

            switch ($selectedMethod) {
                case 'domicilio':
                    $order = $orderService->createDeliveryOrder($payment, $user, $address, (float)$payment->shipping_amount);
                    break;
                case 'sucursal':
                    
                    $order = $orderService->createSucursalOrder($payment, $user, $sucursal, (float)$payment->shipping_amount);
                    break;
                    case 'retiro':
                        $order = $orderService->createRetiroOrder($payment, $user, (float)$payment->shipping_amount);
                        break;
            }
            return $order;
        }
}
