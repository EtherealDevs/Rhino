<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 3; $i++) { 
            $order = Order::create([
                'user_id' => User::all()->random(1)->first()->id,
                'payment_method_id' => PaymentMethod::all()->random(1)->first()->id,
                'total' => null,
                'delivery_service_id' => null,
                'delivery_price' => null,
                'address_id' => null,
            ]);
            $item = ProductItem::all()->random(1)->first();
            $orderDetail = OrderDetail::create([
                'order_id' => $order->id,
                'product_item_id' => $item->id,
                'amount' => rand(1, 5),
                'price' => $item->price()
            ]);
            $order->update([
                'total' => $orderDetail->amount * $orderDetail->price,
            ]);
        }
    }
}
