<?php

namespace App\Livewire;

use App\Models\Combo;
use Livewire\Component;

class CartCombo extends Component
{
    public $items;
    public $subtotal;
    public $combo;
    public $discount;
    public $total;
    public function mount($items, $combo){
        $this->items=$items;
        $this->combo= Combo::where('id',$combo)->first();
        $this->discount= $this->combo->discount;
        foreach($this->items as $item){
            $subtotal = $item['item']->price() * $item['amount'];
            $this->subtotal += $subtotal;
        }
        $this->total = $this->subtotal - (($this->discount/100)*$this->subtotal);
    }
    public function render()
    {
        return view('livewire.cart-combo');
    }
}
