<?php

namespace App\Services;

use App\Models\Address;
use App\Models\DeliveryService;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use MercadoPago\Resources\Payment;

class OrderDetailService
{
    public function createOrderDetail(int $orderId, object $item, int $price, $combo = null)
    {
        $quantity = null;
        if ($combo != null) {
            $quantity = $combo->quantity;
        } else {
            $quantity = $item->quantity;
        }
        $detail = OrderDetail::create([
            'order_id' => $orderId,
            'variation_id' => $item->variation_id,
            'amount' => $quantity,
            'price' => $price,
        ]);
        $variationModel = DB::table('products_sizes')->where('id', $item->variation_id)->first();
        if (($variationModel->stock - $detail->amount) >= 0) {
            DB::transaction(function () use ($variationModel, $detail) {
                $newStock = $variationModel->stock - $detail->amount;
                DB::table('products_sizes')
                    ->where('id', $variationModel->id)
                    ->update(['stock' => $newStock]);
            });
        }
    }
}
