<?php
namespace App\Http\Cart;

use App\Models\Cart as ModelsCart;
use App\Models\ProductItem;
use Exception;

class Cart
{
    public $user;
    public $contents;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public static function addItem(ProductItem $item)
    {
        
        if (session()->missing('cart')) {
            $contents = collect([['id' => $item->id, 'item' => $item, 'amount' => 1]]);
            session()->put('cart', $contents);
        } else{

            $cart = session()->get('cart');

            if ($cart->doesntContain('id', $item->id)){
                $cart->push(['id' => $item->id, 'item' => $item, 'amount' => 1]);
                session()->put('cart', $cart);
            }
            if ($cart->contains('id', $item->id)) {
                $cart->transform(function ($collectionItem) use ($item){
                    if ($collectionItem['id'] == $item->id) {
                        $collectionItem['amount'] += 1;
                    }
                    return $collectionItem;
                });
                session()->put('cart', $cart);
            }
        }
    }

    public static function getCartContents()
    {
        if (session()->has('cart')){
            return session('cart');
        } else return null;
    }

    public static function removeItem(ProductItem $item)
    {
        $cart = session('cart');
        $newCart = $cart->reject(function ($cartItem) use ($item){
            return $cartItem['id'] == $item->id;
        });
        $newCart->whenNotEmpty(function () use ($newCart) {
            session()->put('cart', $newCart);
        }, function () {
            session()->forget('cart');
        });
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
        //Serialize contents (convert to json) so that the database can interpret the data and store correctly.
        $serializedContents = json_encode($contents);

        if ($serializedContents === false) {
            throw new Exception('Failed to serialize contents');
        }

        $cartModel = ModelsCart::updateOrCreate(
            ['user_id' => $user->id],
            ['contents' => $serializedContents, 'total' => $total]
        );

    }
}