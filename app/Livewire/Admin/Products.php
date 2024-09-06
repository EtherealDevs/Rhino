<?php

namespace App\Livewire\Admin;

use App\Models\ProductItem;
use App\Models\ProductsSize;
use App\Models\Size;
use Livewire\Component;

class Products extends Component
{
    public $product;
    public $productItem;
    public $size;
    public $stock;
    public function mount(ProductsSize $product){
        $this->productItem = ProductItem::where('id',$product->product_item_id)->first();
        $this->product = $this->productItem->product;
        $this->size = Size::where('id',$product->size_id)->first();
        $this->stock = $product->stock;
    }
    public function render()
    {
        return view('livewire.admin.products');
    }
}
