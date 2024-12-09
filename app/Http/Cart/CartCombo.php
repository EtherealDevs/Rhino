<?php
namespace App\Http\Cart;

use App\Models\Combo;
use App\Models\ProductItem;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

class CartCombo
{
    const DEFAULT_TYPE = 'combo';

    public $id;
    public $combo_id;
    public $contents;
    public $max_stock;
    public $quantity;
    public $type;
    public function __construct(Combo $combo, array $sizes, $quantity = 1)
    {
        $this->max_stock = $combo->getMaximumAddableAmount();
        $items = collect();
        foreach ($sizes as $key => $value) {
            $size_id = $value;
            dd($key);
            $item_variation_id = DB::table('products_sizes')->where('product_item_id', $key)->where('size_id', $size_id)->first()->id;
            $items->put("item$item_variation_id", ['item_id' => $key, 'variation_id' => $item_variation_id, 'size' => $value]);
        }
        $this->contents = $items;

        $this->combo_id = $combo->id;
        $this->id = self::DEFAULT_TYPE . $combo->id;
        $this->type = self::DEFAULT_TYPE;
        $this->quantity = $quantity;
    }
    public function setId($id)
    {
        $this->id = $id;
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
