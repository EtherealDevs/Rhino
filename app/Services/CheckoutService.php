<?php

namespace App\Services;

use App\Http\Cart\CartCombo;
use App\Http\Cart\CartItem;
use App\Models\Cart;
use App\Models\ProductItem;
use App\Models\ProductSize;
use App\Models\Size;

class CheckoutService
{
    private CartService $cartService;
    private ProductItemService $productItemService;

    public function __construct()
    {
        $this->cartService = new CartService();
        $this->productItemService = new ProductItemService();
    }

    public function buildItems(Cart $cart)
    {

        $items = [];
        $cartItems = [];
        // Code to build checkout items
        foreach ($cart->contents as $item) {

            if ($item['type'] == CartItem::DEFAULT_TYPE) {
                // $sizeModel = Size::where('name', $item['size'])->first();
                $itemModel = ProductItem::where('id', $item['item_id'])->first();
                $itemVariation = ProductSize::find($item['variation_id']);
                $imageUrl = config('app.product_images_directory') . $itemModel->images[0]->url;
                $newItem = [
                    'id' => $itemVariation->id,
                    'title' => $itemModel->product->name,
                    'category_id' => 'fashion',
                    "currency_id" => "ARS",
                    "picture_url" => "$imageUrl",
                    "description" => "Nombre: '{$itemModel->product->name}'. Color: '{$itemModel->color->name}'. Talle: '{$item['size']}'",
                    "quantity" => (int) $item['quantity'],
                    "unit_price" => $itemModel->price() / 100
                ];
                $cartItem = [
                    'units' => $item['quantity'],
                    'value' => $itemModel->price() / 100,
                    'name' => $itemModel->product->name,
                    'imageURL' => $imageUrl . $itemModel->images[0]->url
                ];
                array_push($items, $newItem);
                array_push($cartItems, $cartItem);
            } else if ($item['type'] == CartCombo::DEFAULT_TYPE) {
                foreach ($item['contents'] as $key => $value) {
                    // $sizeModel = Size::where('name', $value['size'])->first();
                    $itemModel = ProductItem::where('id', $value['item_id'])->first();
                    $itemVariation = ProductSize::find($value['variation_id']);
                    $imageUrl = config('app.product_images_directory') . $itemModel->images[0]->url;
                    $newItem = [
                        'id' => $itemVariation->id,
                        'title' => $itemModel->product->name,
                        "description" => "Nombre: '{$itemModel->product->name}'. Color: '{$itemModel->color->name}'. Talle: '{$value['size']}'",
                        "picture_url" => "$imageUrl",
                        'category_id' => 'fashion',
                        "quantity" => $item['quantity'],
                        "currency_id" => "ARS",
                        "unit_price" => $itemModel->price() / 100
                    ];
                    $cartItem = [
                        'units' => $item['quantity'],
                        'value' => $itemModel->price() / 100,
                        'name' => $itemModel->product->name,
                        'imageURL' => $imageUrl . $itemModel->images[0]->url
                    ];
                    array_push($items, $newItem);
                    array_push($cartItems, $cartItem);
                }
            }
        };
        // Return an array of Items, and CartItems
        return [$items, $cartItems];
    }
}
