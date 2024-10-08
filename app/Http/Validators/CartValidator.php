<?php

namespace App\Http\Validators;

use App\Http\Cart\CartCombo;
use App\Http\Cart\CartManager;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartValidator
{
    public $cart;
    public $cartManager;
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->cartManager = new CartManager();
    }
    public function validateCart()
    {
        $contents = $this->cartManager->getCartContents();
        $redirect = false; // Start with `false`

        // Ensure cart is not empty
        if ($contents->isEmpty()) {
            $redirect = true;
            return $redirect;
        }

        foreach ($contents as $item) {
            if ($item->type == CartCombo::DEFAULT_TYPE) {  // Correct type checking
                $passes = $this->validateCartCombo($item); // Validate combo
            } else {
                $passes = $this->validateCartItem($item); // Validate individual item
            }

            // If any item validation fails, set redirect to true
            if (!$passes) {
                $redirect = true;
            }
        }
        return $redirect;
    }
    public function validateCartCombo($item)
    {
        $passes = true; // Start with true and set to false if any validation fails

        foreach ($item->comboItems as $comboItem) { // Assuming `$item` has `comboItems`
            $variationModel = DB::table('products_sizes')->find($comboItem->variation_id);

            // Handle case where variationModel is null (variation doesn't exist)
            if (!$variationModel) {
                $this->cartManager->removeItem($item->id);
                return false;
            }

            // Update quantity based on stock
            if ($comboItem->quantity > $variationModel->stock) {
                $comboItem->quantity = $variationModel->stock;

                if ($variationModel->stock == 0) {
                    $this->cartManager->removeItem($item->id);
                    $passes = false;
                } else {
                    $this->cartManager->updateComboQuantity($comboItem, 'update', $this->cartManager->contents, $comboItem->quantity);
                    $passes = false; // Set to false since quantity was modified
                }
            }
        }

        return $passes; // Return true if all items passed, false otherwise
    }
    public function validateCartItem($item)
    {
        $passes = true; // Start with true

        $variationModel = DB::table('products_sizes')->find($item->variation_id);

        // Handle case where variationModel is null (variation doesn't exist)
        if (!$variationModel) {
            $this->cartManager->removeItem($item->id);
            return false;
        }

        // Update quantity based on stock
        if ($item->quantity > $variationModel->stock) {
            $item->quantity = $variationModel->stock;

            if ($variationModel->stock == 0) {
                $this->cartManager->removeItem($item->id);
                $passes = false;
            } else {
                $this->cartManager->updateItemQuantity($item, 'update', $this->cartManager->contents, $item->quantity);
                $passes = false; // Set to false since quantity was modified
            }
        }

        return $passes;
    }
}
