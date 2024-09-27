<?php

namespace App\Livewire;

use App\Models\Combo;
use Livewire\Component;

class CartCombo extends Component
{
    public $cartItemId;
    public $comboItems;
    public $comboContents;
    public $itemSizes;
    public $itemQuantities;
    public $subtotal;
    public $combo;
    public $quantity;
    public $discount;
    public $total;
    public function mount($cartComboId, $cartCombo){
        $itemSizes = [];
        foreach ($cartCombo->contents as $key => $item)
        {
            $itemSizes[$item->item_id] = $item->size;
        }
        $this->comboContents = $cartCombo->contents;
        $this->quantity = $cartCombo->quantity;
        $this->itemSizes = $itemSizes;
        $this->cartItemId = $cartComboId;
        $this->combo= Combo::where('id',$cartCombo->combo_id)->first();
        $this->comboItems=$this->combo->items;
        $this->discount= $this->combo->discount;
        // foreach($this->items as $item){
        //     $subtotal = $item['item']->price() * $item['amount'];
        //     $this->subtotal += $subtotal;
        // }
        $this->subtotal = $this->combo->getTotalPriceWithoutDiscount() * $this->quantity;
        $this->total = $this->combo->totalPrice() * $this->quantity;
    }
    public function render()
    {
        return view('livewire.cart-combo');
    }
}
