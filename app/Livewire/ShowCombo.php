<?php

namespace App\Livewire;

use App\Models\Combo;
use Livewire\Component;

class ShowCombo extends Component
{
    public $item;
    public $product;
    public $productItem;
    public function mount($item){
        $this->item = $item;
        $this->product = $item->product;
        $this->productItem = $this->product->items->first();
    }
    public function render()
    {
        return view('livewire.show-combo');
    }
}
