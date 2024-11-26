<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Size;
use Livewire\Component;

class Products extends Component
{


    public function render()
    {
        $sizes = Size::all();
        $categories = Category::all();
        $combos = Combo::all();
        $products = Product::with([
            'items.sizes' => function ($query) {
                $query->whereNull('products_sizes.deleted_at') // Filtrar por tamaños válidos
                      ->where('products_sizes.stock', '>', 0);
            },
            'variations' => function ($query) {
                $query->whereNull('products_sizes.deleted_at') // Filtrar por tamaños válidos
                      ->where('products_sizes.stock', '>', 0);
            },
        ])->paginate(10);

        // Pasar $this->products a la vista correctamente
        return view('livewire.products', [
            'products' => $products,
            'categories' => $categories,
            'sizes' => $sizes,
            'combos' => $combos,
        ]);
    }
}
