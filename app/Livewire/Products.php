<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductItem;
use Livewire\Component;

class Products extends Component
{
    
    public function render()
    {
        $productItem = Product::all();
        return view('livewire.products', compact('productItem'));
    }
}
