<?php

namespace App\Services;

use App\Http\Cart\CartCombo;
use App\Http\Cart\CartItem;
use App\Http\Cart\CartManager;
use App\Http\Cart\SessionCartManager;
use App\Models\Combo;
use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public $user;
    public function __construct(User|null $user = null)
    {
        if ($user instanceof User)
        {
            $this->user = $user;
        }
        else {
            $this->user = Auth::user();
        }
    }
    public function transferCart()
    {
        $cartManager = new CartManager();
        $sessionManager = new SessionCartManager();

        $sessionCartContents = $sessionManager->getCartContents();

        $comboModels = Combo::all();
        $productItems = ProductItem::all();
        foreach ($sessionCartContents as $item) {
            if ($item->type == CartItem::DEFAULT_TYPE) {
                $productItem = $productItems->find($item->item_id);
                $cartItem = new CartItem($productItem, $item->size, $item->quantity);
                $cartManager->addItem($cartItem);
            }
            else if ($item->type == CartCombo::DEFAULT_TYPE)
            {
                $comboModel = $comboModels->find($item->combo_id);
                $sizes = [];
                foreach ($item->contents as $value) {
                    $sizes[$value->item_id] = $value->size;
                }
                $combo = new CartCombo($comboModel, $sizes, $item->size);
                $cartManager->addCombo($combo, $item->quantity);
            }
        }
        $sessionManager->dropCart();
    }
    public function getCartItemsProperties()
    {
        $cartManager = Auth::check() ? new CartManager() : new SessionCartManager();
        $cartContents = $cartManager->getCartContents();

        $props = ['volume' => 0, 'weight' => 0, 'total' => 0, 'count' => 0];
        $volume = (float) 0;
        $weight = (float) 0;
        $total = (int) 0;
        $cartItems = $cartContents;
        if ($cartItems->isNotEmpty()) {
            $itemCount = 0;
            $models = ProductItem::all()->load('product');
            $combos = Combo::all();
            foreach ($cartItems as $item) {
                if ($item->type == CartItem::DEFAULT_TYPE) {
                    $itemModel = $models->find($item->item_id);
                    $itemQuantity = $item->quantity;
                    $discount = $itemModel->product->sale->sale->discount ?? 0;
                    $price = $itemModel->price();
                    $priceDiscount = ($price * $discount) / 100;
                    $volume += $itemModel->product->volume;
                    $weight += $itemModel->product->weight;
                    $itemCount += $itemQuantity;
                    $total += ($price - $priceDiscount) * $itemQuantity;
                } else if ($item->type == CartCombo::DEFAULT_TYPE) {
                    $combo = $combos->find($item->combo_id);
                    $discount = 1 - ($combo->discount / 100);
                    $subTotal = 0;
                    foreach ($item->contents as $cartItem) {
                        $itemModel = $models->find($cartItem->item_id);
                        $itemQuantity = $item->quantity;
                        $price = $itemModel->price();
                        $priceDiscount = ($price * $discount) / 100;
                        $volume += $itemModel->product->volume;
                        $weight += $itemModel->product->weight;
                        $itemCount += $itemQuantity;
                        $subTotal += $price * $itemQuantity;
                    }
                    $total += (int) ($subTotal * $discount);
                }
            }
            $props['volume'] = $volume;
            $props['weight'] = $weight;
            $props['total'] = $total;
            $props['count'] = $itemCount;
            return $props;
        }
    }
}