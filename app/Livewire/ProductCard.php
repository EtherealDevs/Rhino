<?php

namespace App\Livewire;

use App\Models\ProductItem;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public $item;

    public function mount($product, $item)
    {
        $this->product = $product;
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
