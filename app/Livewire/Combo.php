<?php

namespace App\Livewire;

use App\Models\Combo_items;
use Livewire\Component;

class Combo extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
{
    $items = Combo_items::where('combo_id', $this->id)
        ->with('product', 'product.items.images') // Asegúrate de cargar las relaciones necesarias
        ->get();

    $price = 0;

    foreach ($items as $item) {
        if ($item->product && $item->product->items->first()) {
            $price += $item->product->items->first()->price();
        }
    }

    // Define $image y $image2, asumiendo que es una colección de imágenes
    $image = $items->isNotEmpty() && $items->first()->product && $items->first()->product->items->isNotEmpty()
        ? $items->first()->product->items->first()->images
        : collect(); // Usamos una colección vacía en lugar de null

    $image2 = $items->isNotEmpty() && $items->last()->product && $items->last()->product->items->isNotEmpty()
        ? $items->last()->product->items->first()->images
        : collect(); // Usamos una colección vacía en lugar de null

    return view('livewire.combo', compact('items', 'price', 'image', 'image2'));
}
}
