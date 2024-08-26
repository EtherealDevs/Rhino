<?php

namespace App\Livewire;

use App\Models\Combo_items;
use Livewire\Component;

class Combo extends Component
{
    public $id;
    public function mount($id){
        $this->id = $id;
    }
    public function render()
    {
        $items= Combo_items::where('combo_id', $this->id)->get();
        $price = 0;
        foreach($items as $item){
            $price += $item->product->items->first()->price();
        }
        $items= Combo_items::where('combo_id', $this->id)->limit(2)->get();
        return view('livewire.combo',compact('items','price'));
    }
}
