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
    /**
     * Retrieves the contents of the user's cart from the database.
     *
     * @return \Illuminate\Support\Collection A collection of cart items. Each item is an associative array with keys 'id', 'quantity', and 'size'.
     *
     * @throws Exception If the contents of the cart cannot be decoded from JSON.
     */
    public function getCartContents()
    {
        return is_null($this->databaseCart->contents) ? collect() : collect(json_decode($this->databaseCart->contents));
    }
    /**
     * Get the total amount of the cart from the database.
     *
     * @return int The total amount of the cart.
     */
    public function getCartTotal()
    {
        return $this->databaseCart->total;
    }
    /**
     * Updates the shopping cart with the provided contents.
     *
     * @param Illuminate\Support\Collection $contents The new contents of the shopping cart.
     *
     * @return void
     */
    public function updateCart($contents)
    {
        $contents = $contents->sortBy('type');
        $this->updateCartContents($contents);
        $this->updateCartTotal();
    }
    /**
     * Updates the contents of the user's cart in the database.
     *
     * @param array $newContents An associative array representing the new contents of the cart.
     * Each item in the array is an associative array with keys 'item_id', 'type', 'quantity', and 'size'.
     *
     * @return void
     *
     * @throws Exception If the new contents cannot be encoded to JSON.
     */
    public function updateCartContents($newContents)
    {
        $this->databaseCart->contents = json_encode($newContents);
        if ($this->databaseCart->contents === false) {
            throw new Exception('Failed to encode cart contents to JSON');
        }
        $this->databaseCart->save();
    }
    /**
     * Updates the total cost of the user's cart by calculating the sum of the products of each item's price and quantity.
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
    /**
     * Adds an item to the user's cart.
     *
     * @param CartItem $cartItem The item to be added to the cart.
     *
     * @return void
     *
     * @throws Exception If the item with the given ID already exists in the cart and cannot be increased in quantity.
     */
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
    /**
     * Removes an item from the user's cart.
     *
     * @param string $itemId The unique identifier of the item to be removed.
     *
     * @return void
     *
     * @throws Exception If the item with the given ID does not exist in the cart.
     */
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
    // public function getComboMaxStock(CartCombo $combo, $quantity)
    // {
    //     $contents = $this->getCartContents();
    //     $max_stock = $combo->max_stock;
    //     foreach ($contents as $item)
    //     {
    //         dd($contents, $item, $combo);
    //     }
    // }

    // public static function addCombo(CartItem $cartItem, $amount = 1)
    // {
    //     if (session()->missing('cart')) {
    //         // Crear los contenidos del carrito y ponerlos en la sesion bajo la variable 'cart'
    //         $contents = collect([[$cartItem, $amount]]);
    //         session()->put('cart', $contents);
            
    //     } else{
    //         // Get carrito desde la sesion
    //         $cart = session()->get('cart');

    //         foreach ($cart as $cartItem) {
    //             $notFound = true;
    //             // Si el carrito ya contiene el item que se quiere añadir
                
    //             if ($cartItem['id'] == $cartItem->id) 
    //             {
    //                 $stock = $cartItem->contents->getLowestStockValue();
    //                 $notFound = false;
    //                 // Iterar a traves de todo el carrito. Una vez encontrado el item, incrementar 'amount'.
    //                     $cart->transform(function ($collectionItem) use ($cartItem, $amount, $stock)
    //                     {
    //                         if ($collectionItem['id'] == $cartItem->id) 
    //                         {
    //                             $addedItems = 0;
    //                             for ($i=0; $i < $amount; $i++)
    //                             {
    //                                 if ($collectionItem['amount'] == $stock) 
    //                                 {
    //                                     session()->flash('cartError', "No se pueden añadir todas las unidades de combo solicitadas, porque supera el stock disponible. Pediste {$amount}, solo se añadieron {$addedItems}.");
    //                                     return $collectionItem;
    //                                 }
    //                                 $collectionItem['amount'] += 1;
    //                                 $addedItems += 1;
    //                             }
    //                         }
    //                         return $collectionItem;
    //                     });
    //                 // Guardar en sesion
    //                 session()->put('cart', $cart);
    //             }
    //             // Si el carrito todavia no contiene el item que se quiere añadir
    //         }
    //         if ($notFound)
    //         {
    //             // Añadir al carrito como item nuevo, y guardar en sesion
    //             $cart->push(['item' => $cartItem, 'amount' => $amount]);
    //             session()->put('cart', $cart);
    //         }
    //     }
    // }

    // public static function addItem(ProductItem $item, $amount = 1, $size = null)
    // {
        
    //     if ($size == null) {
    //         $size = $item->sizes()->first()->name;
    //     }
    //     $stock = $item->sizes()->where('name', $size)->first()->pivot->stock;

    //     // Si todavia no hay un carrito registrado en la sesion
    //     if (session()->missing('cart')) {
    //         // Crear los contenidos del carrito y ponerlos en la sesion bajo la variable 'cart'
    //         $contents = collect([['id' => $item->id, 'item' => $item->withoutRelations(), 'size' => $size, 'amount' => $amount]]);
    //         session()->put('cart', $contents);
            
    //     } else{
    //         // Get carrito desde la sesion
    //         $cart = session()->get('cart');

    //         foreach ($cart as $cartItem) {
    //             $notFound = true;
    //             // Si el carrito ya contiene el item que se quiere añadir
    //             if ($cartItem['id'] == $item->id && $cartItem['size'] == $size) 
    //             {
    //                 $notFound = false;
    //                 // Iterar a traves de todo el carrito. Una vez encontrado el item, incrementar 'amount'.
    //                     $cart->transform(function ($collectionItem) use ($item, $amount, $size, $stock)
    //                     {
    //                         if ($collectionItem['id'] == $item->id && $collectionItem['size'] == $size) 
    //                         {
    //                             $addedItems = 0;
    //                             for ($i=0; $i < $amount; $i++)
    //                             {
    //                                 if ($collectionItem['amount'] == $stock) 
    //                                 {
    //                                     session()->flash('cartError', "No se pueden añadir todas las unidades solicitadas, porque supera el stock disponible del producto. Pediste {$amount}, solo se añadieron {$addedItems}.");
    //                                     return $collectionItem;
    //                                 }
    //                                 $collectionItem['amount'] += 1;
    //                                 $addedItems += 1;
    //                             }
    //                         }
    //                         return $collectionItem;
    //                     });
    //                 // Guardar en sesion
    //                 session()->put('cart', $cart);
    //             }
    //             // Si el carrito todavia no contiene el item que se quiere añadir
    //         }
    //         if ($notFound)
    //         {
    //             // Añadir al carrito como item nuevo, y guardar en sesion
    //             $cart->push(['id' => $item->id, 'item' => $item->withoutRelations(), 'size' => $size, 'amount' => $amount]);
    //             session()->put('cart', $cart);
    //         }
    //     }
    // }

    // cartModel se refiere al modelo de eloquent CartModel
    // public static function getCartContents($cartModel = null)
    // {
        
    //     // Si cartModel no es nulo, es decir, que Sí hay un carrito guardado en la base de datos.
    //     if ($cartModel != null) {
    //         // Decodificar los contenidos del modelo (JSON) en un valor PHP
    //         $decodedContents = json_decode($cartModel->contents, true);
    //         $collection = collect([]);
    //         // Iterar a traves de los contenidos del modelo. Buscar en la base de datos cada item decodificado, para asi traer cada item desde la base de datos con todas las relaciones y propiedades. Por cada item, añadir a una coleccion.
    //         foreach ($decodedContents as $decodedItem) {
    //             $item = ProductItem::where('id', $decodedItem['id'])->first();
    //             $collection->push(['id' => $item->id, 'item' => $item->withoutRelations(), 'size' => $decodedItem['size'], 'amount' => $decodedItem['amount']]);
    //         }
    //         // Guardar en 'cart' la coleccion creada mas arriba
    //         session()->put('cart', $collection);
    //         return session('cart');
    //         // Si la sesion ya tiene un carrito guardado, retornar ese carrito
    //     }  else if (session()->has('cart')){
    //         return session('cart');
    //     };
    // }

    // public static function removeItem(ProductItem $item, $size, $user = null)
    // {
    //     $cart = session('cart');
    //     // Aca se usa la la funcion reject para iterar a traves de los contenidos del carrito, a medida que se va iterando se transforma la coleccion, rechazando el item proporcionado, eliminándolo.
    //     $newCart = $cart->reject(function ($cartItem) use ($item, $size){
    //         return $cartItem['id'] == $item->id && $cartItem['size'] == $size;
    //     });
    //     if ($user != null) {
    //         self::storeOrUpdateInDatabase($user, $newCart);
    //     }
    //     // Cuando el carrito, ya transformado, no quedó vacío, se lo guarda en la sesión como está
    //     $newCart->whenNotEmpty(function () use ($newCart) {
    //         session()->put('cart', $newCart);
    //         // Sin embargo, si al transformarlo queda vacío, se elimina el carrito de la sesión
    //     }, function () {
    //         session()->forget('cart');
    //     });
    //     if(session('cart')==null){
    //         $cartDelete = new CartController();
    //         $cartDelete->dropCart();
    //     }else{
    //         $user = Auth::user();
    //         self::storeOrUpdateInDatabase($user);
    //     }
    // }

    // public static function storeOrUpdateInDatabase($user, $contents = null)
    // {
    //     if ($contents == null) {
    //         $contents = self::getCartContents();
    //     }
    //     $total = 0;
    //     foreach ($contents as $item) {
    //         $itemPrice = $item['item']->price();
    //         $itemAmount = $item['amount'];
    //         $total += $itemPrice * $itemAmount;
    //     }
    //     $contents->transform(function ($item){
    //         $itemWithRelations = ProductItem::where('id', $item['id'])->first()->load('product', 'images');
    //         $item['item'] = $itemWithRelations;
    //         return $item;
    //     });
    //     // Serializar contenidos (convertir a JSON) para que la base de datos pueda interpretar los datos y guardarlos correctamente.
    //     $serializedContents = json_encode($contents);

    //     if ($serializedContents === false) {
    //         throw new Exception('Failed to serialize contents');
    //     }

    //     $cartModel = CartModel::updateOrCreate(
    //         ['user_id' => $user->id],
    //         ['contents' => $serializedContents, 'total' => $total]
    //     );
    // }

    // // Comparar carritos, guardar los items que no tiene el carrito original, y modificar la cantidad de los items que ya tiene.
    // public static function compareAndSaveCarts($databaseCart, $sessionCart, $user)
    // {
    //     $databaseCartContents = json_decode($databaseCart->contents, true);
    //     $databaseCartContents = collect($databaseCartContents);
    //     // Se juntan los carritos usando la funcion merge. Esta funcion toma ambos carritos y añade los productos nuevos as final en una nueva colleccion
        
    //     $newItems = collect([]);
        
    //     $databaseCartContents->transform(function ($item) use ($sessionCart, $newItems)
    //     {
    //         $productItem = ProductItem::where('id', $item['id'])->first();
    //         $stock = $productItem->sizes()->where('name', $item['size'])->first()->pivot->stock;
    //         $item['item'] = $productItem->withoutRelations();
    //         foreach ($sessionCart as $sessionItem){
    //             if ($item['id'] == $sessionItem['id'] && $item['size'] == $sessionItem['size']) {
    //                 $item['amount'] += $sessionItem['amount'];
    //                 if ($item['amount'] > $stock) {
    //                     $item['amount'] -= abs($item['amount'] - $stock);
    //                 }
    //             } else{
    //                 $secondItem = ProductItem::where('id', $item['id'])->first();
    //                 $sessionItem['item'] = $secondItem->withoutRelations();
    //                 $newItems->push($sessionItem);
    //             }
    //         }
    //         return $item;
    //     });
    //     if ($newItems != null) {
    //         $mergedCarts = $databaseCartContents->merge($newItems);
    //     }
    //     self::storeOrUpdateInDatabase($user, $mergedCarts);
    // }
}