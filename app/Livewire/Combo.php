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
    $combo_items = Combo_items::where('combo_id', $this->id)
        ->with('item', 'item.images') // Asegúrate de cargar las relaciones necesarias
        ->get();

    $price = 0;

    
    foreach ($combo_items as $combo_item) {
        // dd($combo_items, $combo_item);
        $price += $combo_item->item->price();
    }

    // Define $image y $image2, asumiendo que es una colección de imágenes
    $image = $combo_items->isNotEmpty() && $combo_items->first()->item && $combo_items->first()->item->images->isNotEmpty()
        ? $combo_items->first()->item->images->first()
        : collect(); // Usamos una colección vacía en lugar de null

    $image2 = $combo_items->isNotEmpty() && $combo_items->last()->item && $combo_items->last()->item->images->isNotEmpty()
        ? $combo_items->last()->item->images->first()
        : collect(); // Usamos una colección vacía en lugar de null

    return view('livewire.combo', compact('combo_items', 'price', 'image', 'image2'));
}
}
