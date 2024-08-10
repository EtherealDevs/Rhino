<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Favorite;

class Navigation extends Component
{
    public $favorites;

    public function mount()
    {
        $this->favorites = Favorite::where('user_id', auth()->id())->get();
    }

    public function addToFavorites($productId)
    {
        Favorite::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            // Puedes agregar campos adicionales como color, talla, etc.
        ]);

        $this->mount(); // Para actualizar la lista de favoritos en el componente
    }

    public function removeFromFavorites($favoriteId)
    {
        Favorite::destroy($favoriteId);

        $this->mount(); // Para actualizar la lista de favoritos en el componente
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
