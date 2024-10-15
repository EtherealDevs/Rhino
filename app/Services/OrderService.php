<?php
namespace App\Services;

use App\Http\Cart\CartCombo;
use App\Models\Address;
use App\Models\Combo;
use App\Models\DeliveryService;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\ProductItem;
use App\Models\Province;
use App\Models\User;
use App\Models\ZipCode;
use MercadoPago\Resources\Payment;

class OrderService
{
    /**
     * Create an order based on a MercadoPago order. Delivery
     *
     * @param \MercadoPago\Resources\Payment $mpOrder The MercadoPago order.
     * @param \App\Models\User $user The user model.
     * @param \App\Models\Address $address The address model.
     * @param float $shippingCosts The price of the shipping services' delivery.
     * 
     * @return \App\Models\Order $order.
     */
    public function createDeliveryOrder(Payment $mpOrder, User $user, Address $address, float $shippingCosts)
    {
        $orderDetailService = new OrderDetailService();
        $items = collect(json_decode($user->cart->contents));

        $shippingCosts = (int) ($shippingCosts * 100);
        $total = (int) ($mpOrder->transaction_amount * 100);
        
        $payment_methods = ['credit_card' => 4, 'debit_card' => 3];
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => $payment_methods[$mpOrder->payment_method->type],
            'total' => $total,
            'delivery_service_id' => DeliveryService::where('name', 'oca')->first()->id,
            'delivery_price' => $shippingCosts,
            'address_id' => $address->id,
            'order_status_id' => 1,
        ]);

        $productItems = ProductItem::whereIn('id', $items->pluck('item_id'))->get();

        foreach ($items as $item) {
            if ($item->type == CartCombo::DEFAULT_TYPE) {
                foreach ($item->contents as $comboItem) {
                    $productItem = $productItems->find($comboItem->item_id);
                    $orderDetailService->createOrderDetail($order->id, $item, $productItem->price());
                }
            }
            else {
                $productItem = $productItems->find($item->item_id);
                $orderDetailService->createOrderDetail($order->id, $item, $productItem->price());
            }
        }
        return $order;
    }
    /**
     * Create an order based on a MercadoPago order. Sucursal
     *
     * @param \MercadoPago\Resources\Payment $mpOrder The MercadoPago order.
     * @param \App\Models\User $user The user model.
     * @param array $sucursal The sucursal.
     * @param float $shippingCosts The price of the shipping services' delivery.
     * 
     * @return \App\Models\Order $order.
     */
    public function createSucursalOrder(Payment $mpOrder, User $user, array $sucursal, float $shippingCosts)
    {
        $orderDetailService = new OrderDetailService();
        $items = collect(json_decode($user->cart->contents));

        $shippingCosts = (int) ($shippingCosts * 100);
        $total = (int) ($mpOrder->transaction_amount * 100);
        $provinces = Province::all();
        $zipCode = ZipCode::where('code', '=', $sucursal['CodigoPostal'])->first()->load('province');
        $observation = "Torre:" . ($sucursal['Torre'] == null ? "Null" : $sucursal['Torre']) . " Piso:" . ($sucursal['Piso'] == null ? "Null" : $sucursal['Piso']) . " Localidad:" . $sucursal['Localidad'] . " Latitud:" . $sucursal['Latitud'] . " Longitud:" . $sucursal['Longitud'] . " TipoAgencia:" . $sucursal['TipoAgencia'] ?? "Null" . " HorarioAtencion:" . $sucursal['HorarioAtencion'] ?? "Null";
        $address = Address::firstOrCreate(['name' => $sucursal['IdCentroImposicion']], [
            'user_id' => 1,
            'name' => $sucursal['IdCentroImposicion'],
            'last_name' => $sucursal['Sucursal'],
            'phone_number' => $sucursal['Telefono'],
            'zip_code_id' => $zipCode->id,
            'province_id' => $zipCode->province->id,
            'address' => $sucursal['Calle'],
            'number' => $sucursal['Numero'],
            'department' => $sucursal['Depto'] == null ? 'null' : $sucursal['Depto'],
            'observation' => $observation,
        ]);
        
        $payment_methods = ['credit_card' => 4, 'debit_card' => 3];
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => $payment_methods[$mpOrder->payment_method->type],
            'total' => $total,
            'delivery_service_id' => DeliveryService::where('name', 'oca')->first()->id,
            'delivery_price' => $shippingCosts,
            'address_id' => $address->id,
            'order_status_id' => 1,
        ]);

        $productItems = ProductItem::whereIn('id', $items->pluck('item_id'))->get();

        foreach ($items as $item) {
            if ($item->type == CartCombo::DEFAULT_TYPE) {
                foreach ($item->contents as $comboItem) {
                    $productItem = $productItems->find($comboItem->item_id);
                    $orderDetailService->createOrderDetail($order->id, $item, $productItem->price());
                }
            }
            else {
                $productItem = $productItems->find($item->item_id);
                $orderDetailService->createOrderDetail($order->id, $item, $productItem->price());
            }
        }
        return $order;
    }
}

?>