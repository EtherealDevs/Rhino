<?php
namespace App\Services;

use App\Models\Order;
use MercadoPago\Resources\Payment;

class OrderService
{
    /**
     * Create an order based on a MercadoPago order.
     *
     * @param $mpOrder The MercadoPago order.
     * @param int|string $size The size of the item. Can be an integer (size ID) or a string (size name).
     * @return \Illuminate\Database\Eloquent\Model|object|null The pivot table record for the item variation.
     */
    public function createOrder(Payment $mpOrder)
    {
        $payment_methods = ['debit_card' => ['id' => 3], 'credit_card' => ['id' =>4]];
        $order = Order::create([
            'payment_method_id' => $payment_methods[$mpOrder->payment_method_id]['id'],
            'total' => (int) ($mpOrder->transaction_amount * 100),

        ]);
    }
}

?>