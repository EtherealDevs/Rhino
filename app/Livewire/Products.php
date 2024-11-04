<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Combo;
use App\Models\ProductItem;
use App\Models\ProductSize;
use App\Models\Size;
use Livewire\Component;
use Illuminate\Http\Request;

class Products extends Component
{
    public $search;
    public $filter =[""];
    public function render(Request $request)
    {
        $sizes = Size::all();
        $categories = Category::all();
        $products = Product::all();
        $combos = Combo::all();
        return view('livewire.products', compact('products', 'categories', 'sizes', 'combos'));
    }

}
