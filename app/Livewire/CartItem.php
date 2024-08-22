<?php

namespace App\Livewire;

use App\Models\Image;
use App\Models\Product;
use Livewire\Component;

class CartItem extends Component
{
    public $item;
    public $product;
    public $images;
    public function mount($item)
    {
        $this->product = Product::where('id', $item['item']->product_id)->first();
        $this->images = Image::where('imageable_id', '=', $item['item']->id)->where('imageable_type', '=', 'App\Models\ProductItem')->get();
        $this->item = $item;
    }
    public function render()
    {
        return view('livewire.cart-item');
    }
}
