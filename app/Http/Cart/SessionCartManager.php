<?php
namespace App\Http\Cart;

use App\Models\Combo;
use App\Models\ProductItem;
use Exception;
use Illuminate\Support\Facades\DB;

class SessionCartManager
{
    const CART_NAME = 'cart';
    const CART_TOTAL = 'cart_total';

    public $total;
    public $contents;
    public function __construct()
    {
        $cart = session(self::CART_NAME) ? session(self::CART_NAME) : session()->put(self::CART_NAME, collect());
        $total = session(self::CART_TOTAL) ? session(self::CART_TOTAL) : session()->put(self::CART_TOTAL, 0);
        $this->total = $total;
        $this->contents = $cart;
    }
    public static function checkIfCartExists()
    {
        return !is_null(session(self::CART_NAME));
    }
    public function countItems()
    {
        $contents = $this->getCartContents();
        return $contents->sum('quantity');
    }

    public function getCartContents()
    {
        return session(self::CART_NAME) ? collect(json_decode(session(self::CART_NAME))) : session()->put(self::CART_NAME, collect());
    }

    public function getCartTotal()
    {
        return session(self::CART_TOTAL) ? session(self::CART_TOTAL) : session()->put(self::CART_TOTAL, 0);
    }

    public function setCartTotal($total)
    {
        $this->total = $total;
        session()->put(self::CART_TOTAL, $this->total);
    }

    public function updateCart($contents)
    {
        $contents = $contents->sortBy('type');
        $this->updateCartContents($contents);
        $this->updateCartTotal();
    }

    public function updateCartContents($contents)
    {
        if (!$contents instanceof \Illuminate\Support\Collection) {
            throw new Exception("Invalid contents provided. Expected an instance of Illuminate\Support\Collection.");
        }

        session()->put(self::CART_NAME, $contents);
    }

    public function updateCartTotal()
    {
        $contents = $this->getCartContents();
        $total = 0;

        // Iterate through each item in the cart
        foreach ($contents as $item) {
            if ($item->type == CartItem::DEFAULT_TYPE) 
            {
                // Retrieve the item model from the database using the item ID
                $itemModel = ProductItem::where('id', $item->item_id)->first();

                // Calculate the price of the item
                $itemPrice = $itemModel->price();

                // Get the quantity of the item
                $itemQuantity = $item->quantity;

                // Add the product of the item's price and quantity to the total
                $total += $itemPrice * $itemQuantity;
            } else if ($item->type == CartCombo::DEFAULT_TYPE)
            {
                // Retrieve the combo model from the database using the combo ID
                $comboModel = Combo::where('id', $item->combo_id)->first();

                // Calculate the price of the item
                $comboPrice = $comboModel->totalPrice();

                // Get the quantity of the item
                $comboQuantity = $item->quantity;

                // Add the product of the item's price and quantity to the total
                $total += $comboPrice * $comboQuantity;
            }
        }

        // Update the total cost of the cart in the database
        $this->setCartTotal($total);
    }

    public function removeItem($cartItemId)
    {
        $contents = $this->getCartContents();

        // Check if the item exists in the cart
        if (!$contents->has($cartItemId)) {
            throw new Exception("Item with ID $cartItemId does not exist in the cart.");
        }

        // Remove the item from the cart
        $contents->forget($cartItemId);

        // Update the cart contents and total
        $this->updateCart($contents);
    }

    public function addItem(CartItem $cartItem, $quantity = 1)
    {
        $contents = $this->getCartContents();
        $item = (object)
        [
            'id' => $cartItem->id,
            'item_id' => $cartItem->item_id,
            'variation_id' => $cartItem->variation_id,
            'type' => $cartItem->type,
            'quantity' => $quantity,
            'size' => $cartItem->size
        ];
        $itemInCart = $contents->get($cartItem->id);
        if ($itemInCart) {
            $cartItemId = $this->getCartItemId($itemInCart);
            $this->updateQuantity($cartItemId, 'add', $quantity);
        } else {
            $contents->put($cartItem->id, $item);
            $this->updateCart($contents);
        }
    }

    public function updateQuantity($cartItemId, $mode, $quantity = 1)
    {
        $contents = $this->getCartContents();
        $itemInCart = $contents->get($cartItemId);
        $type = $itemInCart->type;

        switch ($type) {
            case CartItem::DEFAULT_TYPE:
                $this->updateItemQuantity($itemInCart, $mode, $contents, $quantity);
                break;
            case CartCombo::DEFAULT_TYPE:
                $this->updateComboQuantity($itemInCart, $mode, $contents, $quantity);
                break;
        }
    }

    public function addCombo(CartCombo $combo, $quantity = 1)
    {
        $contents = $this->getCartContents();
        $cartCombo = (object)
        [
            'id' => $combo->id,
            'combo_id' => $combo->combo_id,
            'type' => $combo->type,
            'contents' => $combo->contents,
            'quantity' => $quantity
        ];

        $itemInCart = $contents->get($combo->id);
        if ($itemInCart)
        {
            $this->updateComboQuantity($itemInCart, 'add', $contents, $quantity);
        } else
        {
            $contents->put($combo->id, $cartCombo);
            $this->updateCart($contents);
        }
    }

    public function updateItemQuantity($itemInCart, $mode, $contents, $quantity = 1)
    {
        $itemVariation = DB::table('products_sizes')->find($itemInCart->variation_id);
        $cartItemId = $this->getCartItemId($itemInCart);
        $success = null;

        switch ($mode) {
            case 'add':
                $newQuantity = $itemInCart->quantity + $quantity;
                if ($newQuantity > $itemVariation->stock)
                {
                    session()->flash('cartError', "No se pueden añadir mas unidades.");
                } else if ($newQuantity <= $itemVariation->stock && $newQuantity != 0 && $newQuantity > 0)
                {
                    $itemInCart->quantity = $newQuantity;
                    $success = true;
                }
                break;
            case 'subtract':
                $newQuantity = $itemInCart->quantity - $quantity;
                if ($newQuantity <= 0)
                {
                    session()->flash('cartError', "No se pueden quitar mas unidades.");
                } else if ($newQuantity <= $itemVariation->stock && $newQuantity > 0)
                {
                    $itemInCart->quantity = $newQuantity;
                    $success = true;
                }
                break;
            case 'update':
                // $this->updateItemQuantity($cartItemId, $quantity);
                break;
        }

        if ($success)
        {
            $contents->put($cartItemId, $itemInCart);
            $this->updateCart($contents);
        }
    }

    public function updateComboQuantity($itemInCart, $mode, $contents, $quantity = 1)
    {
        $cartItemId = $this->getCartItemId($itemInCart);
        $max_stock = $this->updateComboMaxStockBasedOnItemSize($itemInCart);
        $cartItemId = "$itemInCart->type" . "$itemInCart->combo_id";

        $success = null;
        switch ($mode) {
            case 'add':
                $newQuantity = $itemInCart->quantity + $quantity;
                // $comboMaxStock = $this->getComboMaxStock($itemInCart);
                // $max_stock = 
                if ($newQuantity > $max_stock)
                {
                    session()->flash('cartError', "No se pueden añadir mas unidades.");
                } else if ($newQuantity <= $max_stock && $newQuantity != 0 && $newQuantity > 0)
                {
                    $itemInCart->quantity = $newQuantity;
                    $success = true;
                }
                break;
            case'subtract':
                $newQuantity = $itemInCart->quantity - $quantity;
                if ($newQuantity <= 0)
                {
                    session()->flash('cartError', "No se pueden quitar mas unidades.");
                } else if ($newQuantity <= $max_stock && $newQuantity > 0)
                {
                    $itemInCart->quantity = $newQuantity;
                    $success = true;
                }
                break;
            case 'update':
                // $this->updateItemQuantity($cartItemId, $quantity);
                break;
            }
            if ($success)
            {
                $contents->put($cartItemId, $itemInCart);
                $this->updateCart($contents);
            }
    }

    public function getCartItemId($itemInCart)
    {
        switch ($itemInCart->type) {
            case CartItem::DEFAULT_TYPE:
                $cartItemId = "$itemInCart->type" . "$itemInCart->variation_id";
                break;
            case CartCombo::DEFAULT_TYPE:
                $cartItemId = "$itemInCart->type" . "$itemInCart->combo_id";
                break;
        }
        return $cartItemId;
    }

    public function updateComboMaxStockBasedOnItemSize($itemInCart)
    {
        $stocks = collect();
        foreach ($itemInCart->contents as $item) {
            $itemVariation = DB::table('products_sizes')->where('id', $item->variation_id)->first();
            $stocks->push($itemVariation->stock);
        }
        $max_stock = $stocks->min();
        return $max_stock;
    }
    public function dropCart()
    {
        session()->forget(self::CART_NAME);
        session()->forget(self::CART_TOTAL);
    }
}

?>