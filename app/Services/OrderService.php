<?php
namespace App\Services;

use App\Http\Cart\CartCombo;
use App\Models\Address;
use App\Models\Combo;
use App\Models\DeliveryService;
use App\Models\Order;
use App\Models\ProductItem;
use App\Models\User;
use MercadoPago\Resources\Payment;

class OrderService
{
    /**
     * Create an order based on a MercadoPago order.
     *
     * @param \MercadoPago\Resources\Payment $mpOrder The MercadoPago order.
     * @param int|string $size The size of the item. Can be an integer (size ID) or a string (size name).
     * @return \Illuminate\Database\Eloquent\Model|object|null The pivot table record for the item variation.
     */
    public function createDeliveryOrder(Payment $mpOrder, User $user, Address $address, float $shippingCosts)
    {
        $orderDetailService = new OrderDetailService();
        $items = collect(json_decode($user->cart->contents));

        $shippingCosts = (int) ($shippingCosts * 100);
        $total = (int) ($mpOrder->transaction_amount * 100);
        
        $payment_methods = ['debit_card' => ['id' => 3], 'credit_card' => ['id' =>4]];
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => $payment_methods[$mpOrder->payment_type_id]['id'],
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
    public function createSucursalOrder(Payment $mpOrder, User $user, float $shippingCosts)
    {
        //
    }
}

?>