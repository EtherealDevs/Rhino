<?php

namespace App\Http\Controllers;

use App\Http\Cart\CartManager;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\User;
use App\Notifications\OrderNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class CartController extends Controller
{
    public function index(){
        $productItems = ProductItem::all();
        if (Auth::check()) {
            $cartModel = Cart::where('user_id', Auth::user()->id)->first();
            $cartItems = CartManager::getCartContents($cartModel);
        } else{
            $cartItems = CartManager::getCartContents();
        }
        return view('cart.index', ['productItems' => $productItems, 'cartItems' => $cartItems]);
    }
    public function addToCart(Request $request)
    {
        $admins = User::role('admin1')->get();
        
        $decodedItem = json_decode($request->item);
        $item = ProductItem::where('id', $decodedItem->id)->first();

        //Add Item to Cart in session.
        try {
            CartManager::addItem($item);
        } catch (Exception $e) {
            return redirect()->route('cart')->with('failure', $e->getMessage());
        }

        //Check if user logged in. If true persist the Cart to Database
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            CartManager::storeOrUpdateInDatabase($user);
            $cart = Cart::where('user_id',$user->id)->first();
            foreach($admins as $admin){
                $admin->notify(new OrderNotification($cart,$user,['database']));
            }
        }
        return redirect()->route('cart')->with('success');
    }
    public function removeFromCart(Request $request, ProductItem $item)
    {
        $size = $request->size;
        // $item = ProductItem::where('id', json_decode($request->item)->id)->first();
       
        if (auth()->check()) {
            $user = User::where('id', auth()->user()->id)->first();
            CartManager::removeItem($item, $size, $user);
        } else{
            CartManager::removeItem($item, $size);
        }
        if (!session()->has('cart')) {
            session()->forget('cart');
            if (auth()->user()){
                $cart = Cart::where('user_id', auth()->user()->id);
                $cart->delete();
            }
            return redirect('/');
        }
        return redirect()->route('cart')->with('success');
    }

    public function dropCart(Request $request) {
        session()->forget('cart');
        if (auth()->user()){
            $cart = Cart::where('user_id', auth()->user()->id);
            $cart->delete();
        }
        return redirect('/');
    }

    public function envio(){
        $xml = Http::withHeaders([
            "accept-encoding"=> "gzip, deflate, br",
            'Accept'=> '*/*',
        ])
        ->get('http://webservice.oca.com.ar/ePak_tracking/Oep_TrackEPak.asmx/Tarifar_Envio_Corporativo?Cuit=30-53625919-4&Operativa=94584&PesoTotal=1&VolumenTotal=1&CodigoPostalOrigen=3400&CodigoPostalDestino=5000&CantidadPaquetes=1&ValorDeclarado=150');
        $response =@simplexml_load_string($xml->body());
        return view('cart.envio', compact('response'));
    }

    public function calculator(Request $request){
    }
}
