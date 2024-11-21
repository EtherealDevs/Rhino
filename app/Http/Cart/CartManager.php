<?php
namespace App\Http\Cart;

use App\Http\Cart\CartItem;
use App\Models\Cart as CartModel;
use App\Models\Combo;
use App\Models\ProductItem;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartManager
{
    const MINIMUM_QUANTITY = 1;

    protected $databaseCart;
    public $user;
    public $contents;

    public function __construct()
    {
        $this->user = Auth::user();
        if (is_null($this->user->cart)) {
            $this->databaseCart = new CartModel(['contents' => null, 'total' => 0, 'user_id' => $this->user->id]);
            $this->databaseCart->save();
        } else {
            $this->databaseCart = $this->user->cart;
        }
    }
    public static function checkIfCartExists($user)
    {
        $cart = CartModel::where('user_id', $user->id)->first();
        return !is_null($cart);
    }
    public function countItems()
    {
        return $this->getCartContents()->sum('quantity');
    }

    public function getCartContents()
    {
        return is_null($this->databaseCart->contents) ? collect() : collect(json_decode($this->databaseCart->contents));
    }

    public function getCartTotal()
    {
        return $this->databaseCart->total;
    }

    public function updateCart($contents)
    {
        $contents = $contents->sortBy('type');
        $this->updateCartContents($contents);
        $this->updateCartTotal();
    }

    public function updateCartContents($newContents)
    {
        $this->databaseCart->contents = json_encode($newContents);
        if ($this->databaseCart->contents === false) {
            throw new Exception('Failed to encode cart contents to JSON');
        }
        $this->databaseCart->save();
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
                // dd($comboModel);

                // Calculate the price of the item
                $comboPrice = $comboModel->totalPrice();
                // Get the quantity of the item
                $comboQuantity = $item->quantity;

                // Add the product of the item's price and quantity to the total
                $total += $comboPrice * $comboQuantity;
            }
        }

        // Update the total cost of the cart in the database
        $this->databaseCart->total = $total;
        $this->databaseCart->save();
    }

    public function addItem(CartItem $cartItem)
    {
        $contents = $this->getCartContents();
        $item = (object)
        [
            'id' => $cartItem->id,
            'item_id' => $cartItem->item_id,
            'variation_id' => $cartItem->variation_id,
            'type' => $cartItem->type,
            'quantity' => $cartItem->quantity,
            'size' => $cartItem->size
        ];

        $itemInCart = $contents->get($cartItem->id);
        if ($itemInCart)
        {
            $cartItemId = $this->getCartItemId($itemInCart);
            $this->updateQuantity($cartItemId, 'add', $cartItem->quantity);
        } else
        {
            $contents->put($cartItem->id, $item);
            $this->updateCart($contents);
        }
    }

    public function removeItem($itemId)
    {
        $contents = $this->getCartContents();

        // Check if the item exists in the cart
        if (!$contents->has($itemId)) {
            throw new Exception("Item with ID $itemId does not exist in the cart.");
        }

        // Remove the item from the cart
        $contents->forget($itemId);

        // Update the cart contents and total
        $this->updateCart($contents);
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
        $cartItemId = "$itemInCart->type" . "$itemInCart->variation_id";
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
                $itemInCart->quantity = $quantity;
                $success = true;
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
                $itemInCart->quantity = $quantity;
                $success = true;
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
}