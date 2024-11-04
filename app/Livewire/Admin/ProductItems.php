<?php

namespace App\Livewire\Admin;

use App\Models\ProductItem;
use App\Models\ProductSize;
use Livewire\Component;

class ProductItems extends Component
{
    public $product;
    public $productItem;
    public $productItems;
    public $productItemVariations;
    public $size;
    public $stock;
    public $item;
    public $productSize;
    public function mount($id){
        $productItem = ProductItem::find($id);
        // $productItemVariations = $productItems;
        // $this->productSize = $product->items;
        // $this->productItem = ProductItem::where('id', $product->product_item_id)->first();
        $this->productItem = $productItem;
        $this->product = $productItem->product;
        $productItemVariations = ProductSize::has('item')->where('product_item_id', $productItem->id)->get();
        $this->productItemVariations = $productItemVariations;
        // $this->size = Size::where('id',$product->size_id)->first();
        // $this->stock = $product->stock;
        // $this->item = $this->productItem;
    }
    public function render()
    {
        return view('livewire.admin.product-items');
    }
}
