<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Size;
use Livewire\Component;

class Products extends Component
{
    public $search;
    public $filter = [""];
    public $products = [];
    public $selectedCategory = null;

    public function mount()
    {
        // Cargar todos los productos inicialmente
        $this->products = Product::all();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        // Filtrar productos por categoría
        $this->products = Product::where('category_id', $categoryId)->get();
    }

    public function render()
    {
        $sizes = Size::all();
        $categories = Category::all();
        $combos = Combo::all();

        // Pasar $this->products a la vista correctamente
        return view('livewire.products', [
            'products' => $this->products,
            'categories' => $categories,
            'sizes' => $sizes,
            'combos' => $combos,
        ]);
    }
}
