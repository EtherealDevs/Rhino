<?php

namespace Database\Seeders;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class OrderSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            $order = Order::create([
                'user_id' => User::all()->random(1)->first()->id,
                'payment_method_id' => PaymentMethod::all()->random(1)->first()->id,
                'total' => null,
                'delivery_service_id' => null,
                'delivery_price' => null,
                'address_id' => null,
                'order_status_id' => 1, // Asigna un valor predeterminado
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

        for ($i = 0; $i < 3; $i++) {
            $order = Order::create([
                'user_id' => User::all()->random(1)->first()->id,
                'payment_method_id' => PaymentMethod::all()->random(1)->first()->id,
                'total' => null,
                'delivery_service_id' => null,
                'delivery_price' => null,
                'address_id' => null,
                'order_status_id' => 1, // Asigna un valor predeterminado
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

        for ($i = 0; $i < 3; $i++) {
            $order = Order::create([
                'user_id' => User::all()->random(1)->first()->id,
                'payment_method_id' => PaymentMethod::all()->random(1)->first()->id,
                'total' => null,
                'delivery_service_id' => null,
                'delivery_price' => null,
                'address_id' => null,
                'order_status_id' => 1, // Asigna un valor predeterminado
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

        for ($i = 0; $i < 3; $i++) {
            $order = Order::create([
                'user_id' => User::all()->random(1)->first()->id,
                'payment_method_id' => PaymentMethod::all()->random(1)->first()->id,
                'total' => null,
                'delivery_service_id' => null,
                'delivery_price' => null,
                'address_id' => null,
                'order_status_id' => 1, // Asigna un valor predeterminado
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

