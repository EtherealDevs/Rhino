<?php

namespace App\Livewire;

use Livewire\Component;

class ProductCard extends Component
{
    public $productItem;
    public function mount()
    {
        return view('livewire.product-card');
    }
}
