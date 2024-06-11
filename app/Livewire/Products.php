<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductItem;
use App\Models\Size;
use Livewire\Component;

class Products extends Component
{
    public function render()
    {
   $sizes = Size::all();
        $categories = Category::all();
        $products = Product::all();
        return view('livewire.products', compact('products', 'categories', 'sizes'));
    }
}
