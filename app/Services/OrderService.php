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
        
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => PaymentMethod::firstOrCreate(['payment_method' => $mpOrder->payment_method->type])->id,
            'total' => $total,
            'delivery_service_id' => DeliveryService::where('name', 'oca')->first()->id,
            'delivery_price' => $shippingCosts,
            'address_id' => $address->id,
            'order_status_id' => 1,
            'mp_order_id' => $mpOrder->id
        ]);

        $productItems = ProductItem::whereIn('id', $items->pluck('item_id'))->get();
        // dd($productItems, $items);

        foreach ($items as $item) {
            if ($item->type == CartCombo::DEFAULT_TYPE) {
                foreach ($item->contents as $comboItem) {
                    $productItem = ProductItem::find($comboItem->item_id);
                    $orderDetailService->createOrderDetail($order->id, $comboItem, $productItem->price(), $item);
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
        $address = Address::firstOrCreate(['payment_method' => $sucursal['IdCentroImposicion']], [
            'user_id' => 1,
            'name' => $sucursal['IdCentroImposicion'],
            'last_name' => $sucursal['Sucursal'],
            'phone_number' => $sucursal['Telefono'],
            'zip_code_id' => $zipCode->id,
            'province_id' => $zipCode->province->id,
            'address' => $sucursal['Calle'] . ' ' . $sucursal['Numero'],
            'street' => $sucursal['Calle'],
            'number' => $sucursal['Numero'],
            'department' => $sucursal['Depto'] == null ? 'null' : $sucursal['Depto'],
            'observation' => $observation,
        ]);
        
        $payment_methods = ['credit_card' => 4, 'debit_card' => 3];
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => PaymentMethod::firstOrCreate(['payment_method' => $mpOrder->payment_method->type])->id,
            'total' => $total,
            'delivery_service_id' => DeliveryService::where('name', 'oca')->first()->id,
            'delivery_price' => $shippingCosts,
            'address_id' => $address->id,
            'order_status_id' => 1,
            'mp_order_id' => $mpOrder->id
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
     * Create an order based on a MercadoPago order. Retiro
     *
     * @param \MercadoPago\Resources\Payment $mpOrder The MercadoPago order.
     * @param \App\Models\User $user The user model.
     * 
     * @return \App\Models\Order $order.
     */
    public function createRetiroOrder(Payment $mpOrder, User $user)
    {
        $orderDetailService = new OrderDetailService();
        $items = collect(json_decode($user->cart->contents));

        $shippingCosts = 0;
        $total = (int) ($mpOrder->transaction_amount * 100);
        $admin = User::where('name', '=', 'Ethereal')->first();
        $address = Address::firstOrCreate(['name' => 'rino'], ['user_id' => $admin->id, 'last_name' => 'indumentaria', 'phone_number' => '379 4316606', 'zip_code_id' => 1526, 'province_id' => 5, 'address' => 'Milan 1201', 'street' => 'Milan', 'number' => '1201']);

        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => PaymentMethod::firstOrCreate(['payment_method' => $mpOrder->payment_method->type])->id,
            'total' => $total,
            'delivery_service_id' => DeliveryService::where('name', 'Retiro en el Local')->first()->id,
            'delivery_price' => $shippingCosts,
            'address_id' => $address->id,
            'order_status_id' => 1,
            'mp_order_id' => $mpOrder->id
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