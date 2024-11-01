<?php

namespace App\Livewire\Admin;

use App\Models\ProductItem;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Products extends Component
{
    public $product;
    public $productItem;
    public $size;
    public $stock;
    public $item;
    public $productSize;
    public function mount($id){
        $product = ProductSize::find($id);
        $this->productSize = $product;
        $this->productItem = ProductItem::where('id', $product->product_item_id)->first();
        $this->product = $this->productItem->product;
        $this->size = Size::where('id',$product->size_id)->first();
        $this->stock = $product->stock;
        $this->item = $this->productItem;
    }
    public function render()
    {
        return view('livewire.admin.products');
    }
}
