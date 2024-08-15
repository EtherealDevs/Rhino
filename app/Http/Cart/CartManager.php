<?php
namespace App\Http\Cart;

use App\Http\Controllers\CartController;
use App\Models\Cart as CartModel;
use App\Models\ProductItem;
use Exception;
use Illuminate\Support\Facades\Auth;

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
            $contents = collect([['id' => $item->id, 'item' => $item, 'size' => $size, 'amount' => $amount]]);
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
                                for ($i=0; $i < $amount; $i++)
                                {
                                    if ($collectionItem['amount'] >= $stock) 
                                    {
                                        throw new Exception('La cantidad solicitada no esta disponible.');
                                        return $collectionItem;
                                        break;
                                    }
                                    $collectionItem['amount'] += 1;
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
                // dd($cart);
                // // Añadir al carrito como item nuevo, y guardar en sesion
                // $cart->push(['id' => $item->id, 'item' => $item, 'size' => $size, 'amount' => $amount]);
                // session()->put('cart', $cart);
            
            // if ($cart->doesntContain('id', $item->id) || $cart->doesntContain('size', $size))
            // {
            //     dd($cart);
            //     // Añadir al carrito como item nuevo, y guardar en sesion
            //     $cart->push(['id' => $item->id, 'item' => $item, 'size' => $size, 'amount' => $amount]);
            //     session()->put('cart', $cart);
            // }
            // Si el carrito ya contiene el item que se quiere añadir
            // else if ($cart->contains('id', $item->id) && $cart->contains('size', $size)) {
            //     dd($cart);
            //     // Iterar a traves de todo el carrito. Una vez encontrado el item, incrementar 'amount'.
            //     $cart->transform(function ($collectionItem) use ($item, $amount, $size, $stock){
            //         if ($collectionItem['id'] == $item->id && $collectionItem['size'] == $size) {
            //             for ($i=0; $i < $amount; $i++) {
                            
            //                 if ($collectionItem['amount'] >= $stock) {
                                
            //                     throw new Exception('La cantidad solicitada no esta disponible.');
            //                     return $collectionItem;
            //                     break;
            //                 }
            //                 $collectionItem['amount'] += 1;
            //             }
            //         }
            //         return $collectionItem;
            //     });
            //         // Guardar en sesion
            //         session()->put('cart', $cart);
            // }
        }
    }

    // cartModel se refiere al modelo de eloquent CartModel
    public static function getCartContents($cartModel = null)
    {
        // Si la sesion ya tiene un carrito guardado, retornar ese carrito
        if (session()->has('cart')){
            return session('cart');
        // Si cartModel no es nulo, es decir, que Sí hay un carrito guardado en la base de datos.
        } else if ($cartModel != null) {
            // Decodificar los contenidos del modelo (JSON) en un valor PHP
            $decodedContents = json_decode($cartModel->contents, true);
            $collection = collect([]);
            // Iterar a traves de los contenidos del modelo. Buscar en la base de datos cada item decodificado, para asi traer cada item desde la base de datos con todas las relaciones y propiedades. Por cada item, añadir a una coleccion.
            foreach ($decodedContents as $decodedItem) {
                $item = ProductItem::where('id', $decodedItem['id'])->first();
                $collection->push(['id' => $item->id, 'item' => $item, 'size' => $decodedItem['size'], 'amount' => $decodedItem['amount']]);
            }
            // Guardar en 'cart' la coleccion creada mas arriba
            session()->put('cart', $collection);
            return session('cart');
        };
    }
    // public static function getCartTotal($user = null) {
    //     if ($user != null) {
    //         $cartModel = CartModel::where('user_id', $user->id);
    //     } else { $cartModel = null; }
    //     $contents = self::getCartContents($cartModel);
    //     $total = 0;
    //     foreach ($contents as $item) {
    //         $itemPrice = $item['item']->price();
    //         $itemAmount = $item['amount'];
    //         $total += $itemPrice * $itemAmount;
    //     }
    //     return $total;
    // }

    public static function removeItem(ProductItem $item, $size)
    {
        $cart = session('cart');
        // Aca se usa la la funcion reject para iterar a traves de los contenidos del carrito, a medida que se va iterando se transforma la coleccion, rechazando el item proporcionado, eliminándolo.
        $newCart = $cart->reject(function ($cartItem) use ($item, $size){
            return $cartItem['id'] == $item->id && $cartItem['size'] == $size;
        });
        // Cuando el carrito, ya transformado, no quedó vacío, se lo guarda en la sesión como está
        $newCart->whenNotEmpty(function () use ($newCart) {
            session()->put('cart', $newCart);
            // Sin embargo, si al transformarlo queda vacío, se elimina el carrito de la sesión
        }, function () {
            session()->forget('cart');
        });
        if(session('cart')==null){
            $cartDelete = new CartController();
            $cartDelete->dropCart();
        }else{
            $user = Auth::user();
            self::storeOrUpdateInDatabase($user);
        }
    }

    public static function storeOrUpdateInDatabase($user)
    {
        $contents = self::getCartContents();
        $total = 0;
        foreach ($contents as $item) {
            $itemPrice = $item['item']->price();
            $itemAmount = $item['amount'];
            $total += $itemPrice * $itemAmount;
        }
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
}