<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Favorite;
use App\Models\ProductItem;
use Illuminate\Support\Facades\Auth;
use App\Http\Cart\CartManager;

class Navigation extends Component
{
    public $favorites = [];

    public $cartContents = [];

    public function mount()
    {
        // Cargar los favoritos
        $this->loadFavorites();
    }


    public function incrementQuantity($itemId, $size)
    {
        $cart = session('cart', collect([])); // Inicializar como colección vacía
        $cart = $cart->transform(function ($item) use ($itemId, $size) {
            if ($item['id'] == $itemId && $item['size'] == $size) {
                $item['amount'] += 1;
            }
            return $item;
        });
        session()->put('cart', $cart);
        $this->cartContents = $cart->toArray(); // Asegurar que es un array
    }

    public function decrementQuantity($itemId, $size)
    {
        $cart = session('cart', collect([])); // Inicializar como colección vacía
        $cart = $cart->transform(function ($item) use ($itemId, $size) {
            if ($item['id'] == $itemId && $item['size'] == $size && $item['amount'] > 1) {
                $item['amount'] -= 1;
            }
            return $item;
        });
        session()->put('cart', $cart);
        $this->cartContents = $cart->toArray(); // Asegurar que es un array
    }


    public function removeItem($itemId, $size)
    {
        CartManager::removeItem(ProductItem::find($itemId), $size);
        $this->cartContents = CartManager::getCartContents() ?? []; // Asegurar que es un array
    }

    public function clearCart()
    {
        session()->forget('cart');
        $this->cartContents = [];
    }

    public function loadFavorites()
    {
        $this->favorites = Favorite::with('product.images') // Cargar las imágenes de los productos
            ->where('user_id', Auth::id())
            ->get();
    }


    public function addToFavorites($productId)
    {
        $existingFavorite = Favorite::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if (!$existingFavorite) {
            Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
            ]);
        }

        $this->loadFavorites();
    }

    public function removeFromFavorites($favoriteId)
    {
        Favorite::destroy($favoriteId);
        $this->loadFavorites();
    }

    public function render()
    {
        return view('livewire.navigation', [
            'cartContents' => $this->cartContents,
        ]);
    }
}
