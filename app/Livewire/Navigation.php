<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Navigation extends Component
{
    public $favorites = [];

    public function mount()
    {
        $this->loadFavorites();
    }

    public function loadFavorites()
    {
        $this->favorites = Favorite::with('product')
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
        return view('livewire.navigation');
    }
}
