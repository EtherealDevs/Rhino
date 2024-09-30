<?php

namespace App\Services;

use App\Http\Cart\CartCombo;
use App\Http\Cart\CartItem;
use App\Http\Cart\CartManager;
use App\Http\Controllers\DeliveryServiceController;
use App\Models\ProductItem;
use App\Models\Province;
use App\Models\ZipCode;

class ShippingService
{
    public function getShippingCosts($address)
    {
        $cartManager = new CartManager();
        $cartContents = $cartManager->getCartContents();
        $total = 0;
        $itemCount = 0;
        $volume = (float) 0;
        $weight = (float) 0;
        $cartItems = $cartContents;
        if ($cartItems->isNotEmpty()) {
            $itemCount = 0;
            foreach ($cartItems as $item) {
                if ($item->type == CartItem::DEFAULT_TYPE) {
                    $itemModel = ProductItem::find($item->item_id);
                    $itemQuantity = $item->quantity;
                    $discount = $itemModel->product->sale->sale->discount ?? 0;
                    $price = $itemModel->price();
                    $priceDiscount = ($price * $discount) / 100;
                    $volume += $itemModel->product->volume;
                    $weight += $itemModel->product->weight;
                    $itemCount += $itemQuantity;
                    $total += ($price - $priceDiscount) * $itemQuantity;
                } else if ($item->type == CartCombo::DEFAULT_TYPE) {
                    foreach ($item->contents as $cartItem) {
                        $itemModel = ProductItem::find($cartItem->item_id);
                        $itemQuantity = $item->quantity;
                        $discount = $itemModel->product->sale->sale->discount ?? 0;
                        $price = $itemModel->price();
                        $priceDiscount = ($price * $discount) / 100;
                        $volume += $itemModel->product->volume;
                        $weight += $itemModel->product->weight;
                        $itemCount += $itemQuantity;
                        $total += ($price - $priceDiscount) * $itemQuantity;
                    }
                }
            }
        }

        $province = Province::where('id', $address->province->id)->first();
        $code = ZipCode::where('province_id', $province->id)->first();
        $params = ['operativa' => 64665, 'peso' => $weight, 'volumen' => $volume, 'cP' => (int) config('app.delivery_service.origin_zipcode'), 'cPDes' => 1200, 'cantidad' => 1, 'valor' => (int) ($total / 100)];
        $price = DeliveryServiceController::obtenerTarifas($params);
        return (float) $price;
    }
}