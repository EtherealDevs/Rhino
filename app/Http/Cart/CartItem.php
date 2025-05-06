<?php
namespace App\Http\Cart;

use App\Models\Combo;
use App\Models\ProductItem;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Facades\Log;
use stdClass;

class CartItem
{
    const DEFAULT_TYPE = 'item';

    public $id;
    public $item_id;
    public $variation_id;
    public $max_stock;
    public $quantity;
    public $size;
    public $price;
    public $type;
    public $productItemModel;
    public $sizeModel;
    public $pivotModel;
    public function __construct(ProductItem $productItem, $size, $quantity = 1)
    {
        Log::info("Cart Item", ['productItem' => $productItem, 'size' => $size, 'quantity' => $quantity]);
        if ($size instanceof \stdClass) {
            // Get the size ID directly
            $size_id = $size->id ?? null;
        } else {
            // Assume it's a string like "46" and look up the ID
            $size_id = Size::where('name', $size)->value('id');
        }
        
        if (!$size_id) {
            throw new \Exception("Invalid size value: could not resolve size ID.");
        }
        $this->pivotModel = ProductSize::where('product_item_id', $productItem->id)->where('size_id', $size_id)->first();
        $this->productItemModel = $productItem;
        $this->sizeModel = $productItem->sizes()->find($size_id);
        $this->id = self::DEFAULT_TYPE . $this->pivotModel->id;
        $this->variation_id = $this->pivotModel->id;
        $this->max_stock = $this->pivotModel->stock;
        $this->size = $this->sizeModel->name;
        $this->price = $this->productItemModel->price();
        $this->type = self::DEFAULT_TYPE;
        $this->item_id = $this->productItemModel->id;
        $this->quantity = $quantity;
    }

    public function increaseQuantity($quantityInCart)
    {
        $newQuantity = $this->quantity + $quantityInCart;
        if ($newQuantity > $this->max_stock) {
            $addableQuantity = $this->getAddableQuantity($quantityInCart);
            session()->flash('cartError', "No se pueden añadir todas las unidades solicitadas, porque supera el stock disponible del producto. Pediste {$this->quantity}, solo se añadieron {$addableQuantity}.");
            return $this->max_stock;
        } else {
            return $newQuantity;
        }
    }

    public function getAddableQuantity($quantityInCart)
    {
        $remainingStock = $this->max_stock - $quantityInCart;
        if ($remainingStock <= 0) {
            return 0;
        } else {
            return $remainingStock;
        }
    }

}
?>