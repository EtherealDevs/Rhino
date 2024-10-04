<?php

namespace Database\Seeders;

use App\Models\DeliveryService;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
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
        for ($i = 0; $i < 9; $i++) {
            $user = User::inRandomOrder()->first();
            $order = Order::create([
                'user_id' => $user->id,
                'payment_method_id' => PaymentMethod::inRandomOrder()->first()->id,
                'total' => null,
                'delivery_service_id' => DeliveryService::inRandomOrder()->first()->id,
                'delivery_price' => rand(1000, 10000),
                'address_id' => $user->addresses->random()->id,
                'order_status_id' => OrderStatus::inRandomOrder()->first()->id, // Asigna un valor predeterminado
            ]);

            $items = ProductItem::inRandomOrder()->limit(rand(1, 4))->get();
            $subTotal = 0;
            foreach ($items as $key => $value) {
                $orderDetail = OrderDetail::create([
                    'order_id' => $order->id,
                    'variation_id' => $value->getItemPivotModel(rand(1, 2))->id,
                    'amount' => rand(1, 3),
                    'price' => $value->price()
                ]);
                $subTotal += $orderDetail->price * $orderDetail->amount;
            }
            $order->total = $subTotal;
            $order->save();
        }
}
}
