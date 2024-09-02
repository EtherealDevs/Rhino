<?php

namespace App\Livewire;

use App\Models\Combo;
use Livewire\Component;

class CartCombo extends Component
{
    public $items;
    public $total;
    public $combo;
    public $discount;
    public function mount($items, $combo){
        $this->items=$items;
        $this->combo= Combo::where('id',$combo)->first();
        $this->discount= $this->combo->discount;
        foreach($this->items as $item){
            $subtotal = $item['item']->price() * $item['amount'];
            $this->total += $subtotal;
        }
    }
    public function render()
    {
        return view('livewire.cart-combo');
    }
}
