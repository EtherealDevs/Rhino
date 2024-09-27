<?php

namespace App\Services;

use App\Http\Cart\CartCombo;
use App\Http\Cart\CartItem;
use App\Http\Cart\CartManager;
use App\Http\Cart\SessionCartManager;
use App\Models\Combo;
use App\Models\ProductItem;

class CartService
{
    public function transferCart()
    {
        $cartManager = new CartManager();
        $sessionManager = new SessionCartManager();

        $sessionCartContents = $sessionManager->getCartContents();

        foreach ($sessionCartContents as $item) {
            if ($item->type == CartItem::DEFAULT_TYPE) {
                $productItem = ProductItem::find($item->item_id);
                $cartItem = new CartItem($productItem, $item->size, $item->quantity);
                $cartManager->addItem($cartItem);
            }
            else if ($item->type == CartCombo::DEFAULT_TYPE)
            {
                $combo = Combo::find($item->combo_id);
                $sizes = [];
                foreach ($item->contents as $value) {
                    $sizes[$value->item_id] = $value->size;
                }
                $combo = new CartCombo($combo, $sizes);
                $cartManager->addCombo($combo, $item->quantity);
            }
        }
        $sessionManager->dropCart();
    }
}