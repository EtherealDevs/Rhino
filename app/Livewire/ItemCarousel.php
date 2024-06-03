<?php

namespace App\Livewire;

use Livewire\Component;

class ItemCarousel extends Component
{
    public $item;
    public function render()
    {
        return view('livewire.item-carousel');
    }
}
