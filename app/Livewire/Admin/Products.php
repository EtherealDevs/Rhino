<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Products extends Component
{
    public $product;
    public $productItem;
    public $productItems;
    public $size;
    public $stock;
    public $item;
    public $productSize;
    public $productVariation;
    public function mount($id){
        $this->productVariation = ProductSize::find($id);
        $productItem = $this->productVariation->item;
        $this->productItem = $productItem;
        $this->product = $productItem->product;
        $this->stock = $this->productVariation->stock;
        $this->size = $this->productVariation->size;
    }
    public function render()
    {
        return view('livewire.admin.products');
    }
}
