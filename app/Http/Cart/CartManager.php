<?php
namespace App\Http\Cart;

use App\Models\Cart as CartModel;
use App\Models\ProductItem;
use Exception;

class CartManager
{
    public $user;
    public $contents;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public static function addItem(ProductItem $item, $amount = 1, $size = null)
    {
        
        if ($size == null) {
            $size = $item->sizes()->first()->name;
        }
        $stock = $item->sizes()->where('name', $size)->first()->pivot->stock;

        // Si todavia no hay un carrito registrado en la sesion
        if (session()->missing('cart')) {
            // Crear los contenidos del carrito y ponerlos en la sesion bajo la variable 'cart'
            $contents = collect([['id' => $item->id, 'item' => $item->withoutRelations(), 'size' => $size, 'amount' => $amount]]);
            session()->put('cart', $contents);
            
        } else{
            // Get carrito desde la sesion
            $cart = session()->get('cart');

            foreach ($cart as $cartItem) {
                $notFound = true;
                // Si el carrito ya contiene el item que se quiere añadir
                if ($cartItem['id'] == $item->id && $cartItem['size'] == $size) 
                {
                    $notFound = false;
                    // Iterar a traves de todo el carrito. Una vez encontrado el item, incrementar 'amount'.
                        $cart->transform(function ($collectionItem) use ($item, $amount, $size, $stock)
                        {
                            if ($collectionItem['id'] == $item->id && $collectionItem['size'] == $size) 
                            {
                                $addedItems = 0;
                                for ($i=0; $i < $amount; $i++)
                                {
                                    if ($collectionItem['amount'] == $stock) 
                                    {
                                        session()->flash('cartError', "No se pueden añadir todas las unidades solicitadas, porque supera el stock disponible del producto. Pediste {$amount}, solo se añadieron {$addedItems}.");
                                        return $collectionItem;
                                    }
                                    $collectionItem['amount'] += 1;
                                    $addedItems += 1;
                                }
                            }
                            return $collectionItem;
                        });
                    // Guardar en sesion
                    session()->put('cart', $cart);
                }
                // Si el carrito todavia no contiene el item que se quiere añadir
            }
            if ($notFound)
            {
                // Añadir al carrito como item nuevo, y guardar en sesion
                $cart->push(['id' => $item->id, 'item' => $item->withoutRelations(), 'size' => $size, 'amount' => $amount]);
                session()->put('cart', $cart);
            }
        }
    }

    // cartModel se refiere al modelo de eloquent CartModel
    public static function getCartContents($cartModel = null)
    {
        
        // Si cartModel no es nulo, es decir, que Sí hay un carrito guardado en la base de datos.
        if ($cartModel != null) {
            // Decodificar los contenidos del modelo (JSON) en un valor PHP
            $decodedContents = json_decode($cartModel->contents, true);
            $collection = collect([]);
            // Iterar a traves de los contenidos del modelo. Buscar en la base de datos cada item decodificado, para asi traer cada item desde la base de datos con todas las relaciones y propiedades. Por cada item, añadir a una coleccion.
            foreach ($decodedContents as $decodedItem) {
                $item = ProductItem::where('id', $decodedItem['id'])->first();
                $collection->push(['id' => $item->id, 'item' => $item->withoutRelations(), 'size' => $decodedItem['size'], 'amount' => $decodedItem['amount']]);
            }
            // Guardar en 'cart' la coleccion creada mas arriba
            session()->put('cart', $collection);
            return session('cart');
            // Si la sesion ya tiene un carrito guardado, retornar ese carrito
        }  else if (session()->has('cart')){
            return session('cart');
        };
    }

    public static function removeItem(ProductItem $item, $size, $user = null)
    {
        $cart = session('cart');
        // Aca se usa la la funcion reject para iterar a traves de los contenidos del carrito, a medida que se va iterando se transforma la coleccion, rechazando el item proporcionado, eliminándolo.
        $newCart = $cart->reject(function ($cartItem) use ($item, $size){
            return $cartItem['id'] == $item->id && $cartItem['size'] == $size;
        });
        if ($user != null) {
            self::storeOrUpdateInDatabase($user, $newCart);
        }
        // Cuando el carrito, ya transformado, no quedó vacío, se lo guarda en la sesión como está
        $newCart->whenNotEmpty(function () use ($newCart) {
            session()->put('cart', $newCart);
            // Sin embargo, si al transformarlo queda vacío, se elimina el carrito de la sesión
        }, function () {
            session()->forget('cart');
        });
    }

    public static function storeOrUpdateInDatabase($user, $contents = null)
    {
        if ($contents == null) {
            $contents = self::getCartContents();
        }
        $total = 0;
        foreach ($contents as $item) {
            $itemPrice = $item['item']->price();
            $itemAmount = $item['amount'];
            $total += $itemPrice * $itemAmount;
        }
        $contents->transform(function ($item){
            $itemWithRelations = ProductItem::where('id', $item['id'])->first()->load('product', 'images');
            $item['item'] = $itemWithRelations;
            return $item;
        });
        // Serializar contenidos (convertir a JSON) para que la base de datos pueda interpretar los datos y guardarlos correctamente.
        $serializedContents = json_encode($contents);

        if ($serializedContents === false) {
            throw new Exception('Failed to serialize contents');
        }

        $cartModel = CartModel::updateOrCreate(
            ['user_id' => $user->id],
            ['contents' => $serializedContents, 'total' => $total]
        );
    }

    // // Comparar carritos, guardar los items que no tiene el carrito original, y modificar la cantidad de los items que ya tiene.
    public static function compareAndSaveCarts($databaseCart, $sessionCart, $user)
    {
        $databaseCartContents = json_decode($databaseCart->contents, true);
        $databaseCartContents = collect($databaseCartContents);
        // Se juntan los carritos usando la funcion merge. Esta funcion toma ambos carritos y añade los productos nuevos as final en una nueva colleccion
        
        $newItems = collect([]);
        
        $databaseCartContents->transform(function ($item) use ($sessionCart, $newItems)
        {
            $productItem = ProductItem::where('id', $item['id'])->first();
            $stock = $productItem->sizes()->where('name', $item['size'])->first()->pivot->stock;
            $item['item'] = $productItem->withoutRelations();
            foreach ($sessionCart as $sessionItem){
                if ($item['id'] == $sessionItem['id'] && $item['size'] == $sessionItem['size']) {
                    $item['amount'] += $sessionItem['amount'];
                    if ($item['amount'] > $stock) {
                        $item['amount'] -= abs($item['amount'] - $stock);
                    }
                } else{
                    $secondItem = ProductItem::where('id', $item['id'])->first();
                    $sessionItem['item'] = $secondItem->withoutRelations();
                    $newItems->push($sessionItem);
                }
            }
            return $item;
        });
        if ($newItems != null) {
            $mergedCarts = $databaseCartContents->merge($newItems);
        }
        self::storeOrUpdateInDatabase($user, $mergedCarts);
    }
}