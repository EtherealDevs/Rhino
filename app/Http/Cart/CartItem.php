<?php
namespace App\Http\Cart;

use App\Models\Combo;
use App\Models\ProductItem;

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
        $this->pivotModel = $productItem->getItemPivotModel($size);
        $this->productItemModel = $productItem;
        $this->sizeModel = $productItem->sizes()->find($this->pivotModel->size_id);

        $this->id = self::DEFAULT_TYPE . $this->pivotModel->id;
        $this->variation_id = $this->pivotModel->id;
        $this->max_stock = $this->pivotModel->stock;
        $this->size = $this->sizeModel->name;
        $this->price = $this->productItemModel->price();
        $this->type = self::DEFAULT_TYPE;
        $this->item_id = $this->productItemModel->id;
        $this->quantity = $quantity;
    }
    /**
     * Increases the quantity of the product item in the cart.
     *
     * If the new quantity exceeds the available stock, the function calculates the maximum quantity that can be added
     * and flashes a message to the session.
     *
     * @param int $quantityInCart The quantity of the product item currently in the cart.
     *
     * @return int The new quantity of the product item in the cart. If the new quantity exceeds the available stock,
     *              returns the maximum stock.
     */
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

    /**
     * Calculates the quantity that can be added to the cart without exceeding the available stock.
     *
     * @param int $quantityInCart The quantity of the product item currently in the cart.
     *
     * @return int The quantity that can be added to the cart. If the remaining stock is less than or equal to 0, returns 0.
     */
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