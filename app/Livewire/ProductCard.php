<?php

namespace App\Livewire;

use App\Models\ProductItem;
use Livewire\Component;

class ProductCard extends Component
{
    public $productItem;

    public function mount($productItem)
    {
        $this->productItem = $productItem;
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
