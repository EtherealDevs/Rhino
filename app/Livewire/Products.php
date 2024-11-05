<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Size;
use Livewire\Component;
use Illuminate\Http\Request;

class Products extends Component
{
    public $search;
    public $filter =[""];
    public $products = [];
    public $selectedCategory = null;
    public function render(Request $request)
    {
        $sizes = Size::all();
        $categories = Category::all();
        $products = Product::all();
        $combos = Combo::all();
        return view('livewire.products', compact('products', 'categories', 'sizes', 'combos'));
    }

    public function mount()
    {
        $this->products = Product::all(); // Cargar todos los productos inicialmente
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        // Filtrar productos por categoría
        $this->products = Product::where('category_id', $categoryId)->get();
    }
}


