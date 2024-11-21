<?php

namespace App\Listeners;

use App\Events\DeletedItemVariation;
use App\Http\Cart\CartCombo;
use App\Http\Cart\CartItem;
use App\Models\Cart;
use App\Models\ProductItem;
use App\Models\ProductSize;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CartRemoveDeletedItems
{

    public function __construct()
    {
        //
    }

    public function handle(DeletedItemVariation $deletedItemVariation): void
    {
        // DB carts
        $carts = Cart::all();
        $productVariations = ProductSize::withTrashed()->get();
        foreach ($carts as $cart) {
            if ($cart->contents != null) {
                $contents = collect(json_decode($cart->contents));
                foreach ($contents as $item) {
                    if ($item->type === CartItem::DEFAULT_TYPE) {
                        // Variation ID del producto del carrito
                        $productVariation = $productVariations->find($item->variation_id);
                        if ($productVariation->id == $deletedItemVariation->productVariation->id) {
                            $contents->forget($item->id);
                        }
                    }
                    else if ($item->type === CartCombo::DEFAULT_TYPE)
                    {
                        if ($item->contents != null || $item->contents->isNotEmpty()) {
                            $comboContents = collect($item->contents);
                            foreach ($comboContents as $comboItem) {
                                $productVariation = $productVariations->find($comboItem->variation_id);
                                if ($productVariation->id == $deletedItemVariation->productVariation->id) {
                                    $comboContents->forget($comboItem->id);
                                    if ($comboContents == null || $comboContents->isEmpty()) {
                                        $contents->forget($item->id);
                                    }
                                }
                            }
                        }
                    }
                }
                if ($contents == null || $contents->isEmpty()) {
                    $cart->delete();
                    break;
                }
                else {
                    $cart->contents = json_encode($contents);
                    $cart->save();
                }
            }
        }
    }
}
