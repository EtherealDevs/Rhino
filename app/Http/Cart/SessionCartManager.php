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
    
    public function getCartContents()
    {
        return session(self::CART_NAME) ? session(self::CART_NAME) : session()->put(self::CART_NAME, collect());
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

    /**
     * Updates the contents of the shopping cart and recalculates the total cost.
     *
     * @param Illuminate\Support\Collection $contents The new contents of the shopping cart.
     *
     * @return void
     *
     * @throws Exception If the provided contents are not an instance of Illuminate\Support\Collection.
     *
     * @see updateCartContents()
     * @see updateCartTotal()
     */
    public function updateCart($contents)
    {
        $this->updateCartContents($contents);
        $this->updateCartTotal();
    }
    /**
     * Updates the contents of the shopping cart by storing them in the session.
     *
     * @param Illuminate\Support\Collection $contents The new contents of the shopping cart.
     *
     * @return void
     *
     * @throws Exception If the provided contents are not an instance of Illuminate\Support\Collection.
     */
    public function updateCartContents($contents)
    {
        if (!$contents instanceof \Illuminate\Support\Collection) {
            throw new Exception("Invalid contents provided. Expected an instance of Illuminate\Support\Collection.");
        }

        session()->put(self::CART_NAME, $contents);
    }
    /**
     * Updates the total cost of the shopping cart by iterating through each item and calculating the price.
     *
     * @return void
     */
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
    /**
     * Removes an item from the session's cart.
     *
     * @param string $cartItemId The unique identifier of the item to be removed.
     *
     * @return void
     *
     * @throws Exception If the item with the given ID does not exist in the cart.
     */
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
    /**
     * Adds an item to the user's cart.
     *
     * @param CartItem $cartItem The item to be added to the cart.
     *
     * @return void
     *
     * @throws Exception If the item with the given ID already exists in the cart and cannot be increased in quantity.
     */
    public function addItem(CartItem $cartItem, $quantity = 1)
    {
        $contents = $this->getCartContents();
        $item = (object)
        [
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
    /**
     * Updates the quantity of an item in the cart.
     *
     * @param string $cartItemId The unique identifier of the item in the cart.
     * @param string $mode The mode of update (add, subtract, update).
     * @param int $quantity The quantity to update the item with. Default is 1.
     *
     * @return void
     */
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
    /**
     * Adds a combo item to the shopping cart.
     *
     * @param CartCombo $combo The combo item to add.
     * @param int $quantity The quantity of the combo item to add. Default is 1.
     *
     * @return void
     */
    public function addCombo(CartCombo $combo, $quantity = 1)
    {
        $contents = $this->getCartContents();
        $cartCombo = (object)
        [
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
    /**
     * Updates the quantity of an item in the cart.
     *
     * @param object $itemInCart The item in the cart to update.
     * @param string $mode The mode of update (add, subtract, update).
     * @param Illuminate\Support\Collection $contents The current contents of the cart.
     * @param int $quantity The quantity to update the item with. Default is 1.
     *
     * @return void
     */
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
    /**
     * Updates the quantity of a combo item in the shopping cart.
     *
     * @param object $itemInCart The combo item in the cart to update.
     * @param string $mode The mode of update (add, subtract, update).
     * @param Illuminate\Support\Collection $contents The current contents of the shopping cart.
     * @param int $quantity The quantity to update the item to. Default is 1.
     *
     * @return void
     */
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

    /**
     * Generate a unique identifier for an item in the shopping cart.
     *
     * @param object $itemInCart The item in the cart to generate an identifier for.
     * @return string The unique identifier for the item in the cart.
     */
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
    /**
     * Update the maximum stock for a combo item based on its item sizes.
     *
     * @param object $itemInCart The combo item in the cart to update.
     * @return int The maximum stock for the combo item.
     */
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
}

?>