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
    public function mount($id){
        $productVariation = ProductSize::find($id);
        $productItem = $productVariation->item;
        // $productItemVariations = $productItems;
        // $this->productSize = $product->items;
        // $this->productItem = ProductItem::where('id', $product->product_item_id)->first();
        $this->productItem = $productItem;
        $this->product = $productItem->product;
        // $ids = $this->productItems->pluck('id');
        // $productItemVariations = ProductSize::whereIn('id', $ids)->get();
        // $stock = $productItemVariations->pluck('stock');
        $this->stock = $productVariation->stock;
        $this->size = $productVariation->size;
        // $this->size = Size::where('id',$product->size_id)->first();
        // $this->stock = $product->stock;
        // $this->item = $this->productItem;
    }
    public function render()
    {
        return view('livewire.admin.products');
    }
}
