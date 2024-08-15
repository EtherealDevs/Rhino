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
        $item= Combo_items::where('combo_id', $this->id)->first();
        return view('livewire.combo',compact('item'));
    }
}
