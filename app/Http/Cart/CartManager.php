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

    public static function addItem(ProductItem $item, $amount = 1)
    {
        
        if (session()->missing('cart')) {
            $contents = collect([['id' => $item->id, 'item' => $item, 'amount' => $amount]]);
            session()->put('cart', $contents);
        } else{

            $cart = session()->get('cart');

            if ($cart->doesntContain('id', $item->id)){
                $cart->push(['id' => $item->id, 'item' => $item, 'amount' => $amount]);
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

    public static function getCartContents($cartModel = null)
    {
        if (session()->has('cart')){
            return session('cart');
        } else if ($cartModel != null) {
            $json = json_decode($cartModel->contents, true);
            $collection = collect([]);
            foreach ($json as $jsonItem) {
                $item = ProductItem::where('id', $jsonItem['id'])->first();
                $collection->push(['id' => $item->id, 'item' => $item, 'amount' => $jsonItem['amount']]);
            }
            session()->put('cart', $collection);
            return session('cart');
        };
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

        $cartModel = CartModel::updateOrCreate(
            ['user_id' => $user->id],
            ['contents' => $serializedContents, 'total' => $total]
        );

    }
}