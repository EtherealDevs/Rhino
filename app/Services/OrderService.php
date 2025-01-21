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
use App\Models\TransferInfo;
use App\Models\User;
use App\Models\ZipCode;
use Exception;
use MercadoPago\Resources\Payment;

class OrderService
{
    public $transferInfo;
    public function __construct()
    {
        $this->transferInfo = TransferInfo::where('holder_name', '=', 'FACUNDO BERNARD LAGARDE')->first();
    }
    public function createDeliveryOrder(Payment|null $mpOrder, User $user, Address $address, float $shippingCosts, bool $mercadoPago = true)
    {
        $orderDetailService = new OrderDetailService();
        $items = collect(json_decode($user->cart->contents));
        $shippingCosts = (int) ($shippingCosts * 100);

        // throw exception if mp is true and mporder is null
        if ($mpOrder == null && $mercadoPago)
        {
            throw new Exception("mpOrder is null or empty");
        }

        if ($mpOrder != null && $mercadoPago) {
            $total = (int) ($mpOrder->transaction_amount * 100);
        }
        else{
            $total = (int) ($user->cart->total - $user->cart->total * ($this->transferInfo->discount / 100));
        }

        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => $mercadoPago == false ? PaymentMethod::firstOrCreate(['payment_method' => 'transferencia'])->id : PaymentMethod::firstOrCreate(['payment_method' => $mpOrder->payment_method->type])->id,
            'total' => $total,
            'delivery_service_id' => DeliveryService::where('name', 'oca')->first()->id,
            'delivery_price' => $shippingCosts,
            'address_id' => $address->id,
            'order_status_id' => 1,
            'mp_order_id' => $mpOrder != null ? $mpOrder->id : null
        ]);

        $productItems = ProductItem::whereIn('id', $items->pluck('item_id'))->get();

        foreach ($items as $item) {
            if ($item->type == CartCombo::DEFAULT_TYPE) {
                foreach ($item->contents as $comboItem) {
                    $productItem = ProductItem::find($comboItem->item_id);
                    $orderDetailService->createOrderDetail($order->id, $comboItem, $productItem->price(), $item);
                }
            } else {
                $productItem = $productItems->find($item->item_id);
                $orderDetailService->createOrderDetail($order->id, $item, $productItem->price());
            }
        }
        $user->cart->delete();
        return $order;
    }

    public function createSucursalOrder(Payment|null $mpOrder, User $user, array $sucursal, float $shippingCosts, bool $mercadoPago = true)
    {
        $orderDetailService = new OrderDetailService();
        $items = collect(json_decode($user->cart->contents));

        $shippingCosts = (int) ($shippingCosts * 100);

        // throw exception if mp is true and mporder is null
        if ($mpOrder == null && $mercadoPago)
        {
            throw new Exception("mpOrder is null or empty");
        }

        if ($mpOrder != null && $mercadoPago) {
            $total = (int) ($mpOrder->transaction_amount * 100);
        }
        else{
            $total = (int) ($user->cart->total - $user->cart->total * ($this->transferInfo->discount / 100));
        }

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
            'payment_method_id' => $mercadoPago == false ? PaymentMethod::firstOrCreate(['payment_method' => 'transferencia'])->id : PaymentMethod::firstOrCreate(['payment_method' => $mpOrder->payment_method->type])->id,
            'total' => $total,
            'delivery_service_id' => DeliveryService::where('name', 'oca')->first()->id,
            'delivery_price' => $shippingCosts,
            'address_id' => $address->id,
            'order_status_id' => 1,
            'mp_order_id' => $mpOrder != null ? $mpOrder->id : null
        ]);

        $productItems = ProductItem::whereIn('id', $items->pluck('item_id'))->get();

        foreach ($items as $item) {
            if ($item->type == CartCombo::DEFAULT_TYPE) {
                foreach ($item->contents as $comboItem) {
                    $productItem = $productItems->find($comboItem->item_id);
                    $orderDetailService->createOrderDetail($order->id, $item, $productItem->price());
                }
            } else {
                $productItem = $productItems->find($item->item_id);
                $orderDetailService->createOrderDetail($order->id, $item, $productItem->price());
            }
        }
        $user->cart->delete();
        return $order;
    }
    public function createRetiroOrder(Payment|null $mpOrder, User $user, bool $mercadoPago = true)
    {
        $orderDetailService = new OrderDetailService();
        $items = collect(json_decode($user->cart->contents));
        $shippingCosts = 0;

        // throw exception if mp is true and mporder is null
        if ($mpOrder == null && $mercadoPago)
        {
            throw new Exception("mpOrder is null or empty");
        }

        if ($mpOrder != null && $mercadoPago) {
            $total = (int) ($mpOrder->transaction_amount * 100);
        }
        else{
            $total = (int) ($user->cart->total - $user->cart->total * ($this->transferInfo->discount / 100));
        }

        $admin = User::where('name', '=', 'Ethereal')->first();
        $address = Address::firstOrCreate(['name' => 'rino'], ['user_id' => $admin->id, 'last_name' => 'indumentaria', 'phone_number' => '379 4316606', 'zip_code_id' => 1526, 'province_id' => 5, 'address' => 'Milan 1201', 'street' => 'Milan', 'number' => '1201']);

        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => $mercadoPago == false ? PaymentMethod::firstOrCreate(['payment_method' => 'transferencia'])->id : PaymentMethod::firstOrCreate(['payment_method' => $mpOrder->payment_method->type])->id,
            'total' => $total,
            'delivery_service_id' => DeliveryService::where('name', 'Retiro en el Local')->first()->id,
            'delivery_price' => $shippingCosts,
            'address_id' => $address->id,
            'order_status_id' => 1,
            'mp_order_id' => $mpOrder != null ? $mpOrder->id : null
        ]);

        foreach ($items as $item) {
            if ($item->type == CartCombo::DEFAULT_TYPE) {
                foreach ($item->contents as $comboItem) {
                    $productItem = ProductItem::find($comboItem->item_id);
                    $orderDetailService->createOrderDetail($order->id, $comboItem, $productItem->price(), $item);

                }
            } else {
                $productItem = ProductItem::find($item->item_id);
                $orderDetailService->createOrderDetail($order->id, $item, $productItem->price());
            }
        }
        $user->cart->delete();
        return $order;
    }
}
