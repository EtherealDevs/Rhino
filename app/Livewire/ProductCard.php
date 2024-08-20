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
        
        $this->favorites = Favorite::where('user_id', Auth::id())->get();
    }

    public function toggleFavorite($productId)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            // Redirigir al usuario a la vista de inicio de sesión
            return redirect()->route('login');
        }

        // Buscar si el producto ya está en la lista de favoritos
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        // Si ya existe en favoritos, eliminarlo; de lo contrario, agregarlo
        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
            ]);
        }

        // Actualizar la lista de favoritos
        $this->favorites = Favorite::where('user_id', Auth::id())->get();
    }



    public function isFavorite($productId)
    {
        return Favorite::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();
    }


    public function render()
    {
        return view('livewire.product-card');
    }
}
