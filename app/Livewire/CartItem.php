<?php

namespace App\Livewire;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductSize;
use App\Models\Size;
use Livewire\Component;

class CartItem extends Component
{
    public $cartItem;
    public $cartItemId;
    public $quantity;
    public $size;
    public $productItem;
    public $product;
    public $itemVariation;
    public $images;
    public function mount($cartItemId, $cartItem)
    {
        $this->cartItemId = $cartItemId;
        $this->productItem = ProductItem::where('id', $cartItem->item_id)->first();
        $this->cartItem = $this->productItem;
        $this->quantity = $cartItem->quantity;
        $this->size = $cartItem->size;
        $size_id = Size::where('name', '=', $this->size)->first()->id;
        $this->itemVariation = ProductSize::where('product_item_id', $$cartItem->item_id)->where('size_id', $size_id)->first();;
        $this->product = $this->productItem->product;
        $this->images = $this->productItem->images;
    }
    public function render()
    {
        $discount = $this->cartItem['discount'] ?? 0;
        $price = $this->productItem->price(); // Ajusta esto según cómo obtienes el precio
        $total = $price * $this->quantity;
        return view('livewire.cart-item',compact('discount', 'price','total'));
    }
}
