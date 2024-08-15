<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Combo;
use App\Models\ProductItem;
use App\Models\Size;
use Livewire\Component;

class Products extends Component
{
    public $search;
    public $filter =[""];
    public function render()
    {
        $sizes = Size::all();
        $categories = Category::all();
        $products = Product::all();
        $combos = Combo::all();
        return view('livewire.products', compact('products', 'categories', 'sizes','combos'));
    }
}
