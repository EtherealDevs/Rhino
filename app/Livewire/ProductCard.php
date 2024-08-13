<?php

namespace App\Livewire;

use App\Models\ProductItem;
use Livewire\Component;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
class ProductCard extends Component
{
    public $product;
    public $item;
    public $favorites;

    public function addFavorite($productId)
{
    Favorite::create([
        'user_id' => Auth::id(),
        'product_id' => $productId,
    ]);

    // Actualizar la lista de favoritos si es necesario
    $this->favorites = Favorite::where('user_id', Auth::id())->get();
}


    public function render()
    {
        return view('livewire.product-card');
    }
}
