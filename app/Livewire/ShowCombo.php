<?php

namespace App\Livewire;

use App\Models\Combo;
use App\Models\ProductsSize;
use App\Models\Size;
use Livewire\Component;

class ShowCombo extends Component
{
    public $item;
    public $product;
    public $productItem;
    public $size;
    public function mount($item){
        $this->item = $item;
        $this->product = $item->product;
        $this->productItem = $this->product->items->first();
    }
    public function updatedSize($size)
    {
        $model = Size::find($size);
        $this->dispatch('updatedSize', size_array : [$this->item->id => $model->name]);
    }
    public function render()
    {
        return view('livewire.show-combo');
    }
}
