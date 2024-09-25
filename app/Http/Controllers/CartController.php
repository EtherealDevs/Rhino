<?php

namespace App\Http\Controllers;

use App\Http\Cart\CartCombo;
use App\Http\Cart\CartManager;
use App\Models\Cart;
use App\Models\Combo;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\User;
use App\Notifications\OrderNotification;
use App\Http\Cart\CartItem;
use App\Http\Cart\SessionCartManager;
use App\Models\Size;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class CartController extends Controller
{
    protected $cartManager;
    // Inyectar el CartManager en el constructor del controlador
    public function __construct()
    {
        if (Auth::user() == null)
        {
            $cartManager = new SessionCartManager();
            $this->cartManager = $cartManager;
        }
        else if (Auth::user()) {
            $cartManager = new CartManager();
            $this->cartManager = $cartManager;
        }
    }



    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        $productItems = ProductItem::all();
        if (Auth::check()) {
            $cartItems = $this->cartManager->getCartContents();
        } else{
            // $cartItems = CartManager::getCartContents();
        }
        // $groupedCartItems = $cartItems->groupBy(function($item) {
        //     return $item['item']->product->combo->combo->id ?? null; // Asumiendo que `combo_id` es el identificador del combo
        // });
        // return view('cart.index', ['productItems' => $productItems, 'groupedCartItems' => $groupedCartItems]);
        return view('cart.index', ['productItems' => $productItems, 'cartItems' => $cartItems]);
    }

    /**
     * Adds a product item to the shopping cart.
     *
     * @param Request $request The incoming request containing the necessary parameters.
     * @return \Illuminate\Http\RedirectResponse Redirects to the shopping cart page with success or failure message.
     *
     * @throws \Exception If the product item or size is not found.
     */
    public function addToCart(Request $request)
    {
        // Decode the item and size from the request parameters
        $decodedItem = json_decode($request->item);
        $size = json_decode($request->size);
        $quantity = $request->quantity;

        // Retrieve the product item from the database
        $item = ProductItem::where('id', $decodedItem->id)->first();

        // If the product item is not found, throw an exception
        if (!$item) {
            throw new Exception('Product item not found');
        }

        // Create a new cart item
        $cartItem = new CartItem($item, $size);

        // Add the cart item to the shopping cart
        $this->cartManager->addItem($cartItem);

        // If there is a cart error, redirect back with a failure message
        if (session('cartError')) {
            return redirect()->route('cart')->with('failure', session('cartError'));
        }

        // Redirect back with a success message
        return redirect()->route('cart')->with('success');
    }
    public function removeFromCart(Request $request)
    {

        $this->cartManager->removeItem($request->cartItemId);
        // $size = $request->size;
        // // $item = ProductItem::where('id', json_decode($request->item)->id)->first();

        // if (auth()->check()) {
        //     $user = User::where('id', auth()->user()->id)->first();
        //     CartManager::removeItem($item, $size, $user);
        // } else{
        //     CartManager::removeItem($item, $size);
        // }
        // if (!session()->has('cart')) {
        //     session()->forget('cart');
        //     if (auth()->user()){
        //         $cart = Cart::where('user_id', auth()->user()->id);
        //         $cart->delete();
        //     }
        //     return redirect('/');
        // }
        return redirect()->route('cart')->with('success');
    }
    public function updateFromCart(Request $request)
    {
        // $request->validate([
        //     'mode' => 'required|in:subtract,add,update',
        //     'cartItemId' => 'required|numeric'
        // ]);

        $cartItemId = $request->cartItemId;
        //add, subtract, update
        $mode = $request->mode;
        $this->cartManager->updateQuantity($cartItemId, $mode);
        return redirect()->route('cart');
    }
    public function addComboToCart(Request $request)
    {
        $request->validate([
            'comboId' =>'required|numeric'
        ]);
        $combo = Combo::where('id', $request->comboId)->first();
        $sizes = json_decode($request->sizes, true);
        // Añadir Combo  al carrito de la sesión.
        $cartCombo = new CartCombo($combo, $sizes);
        $this->cartManager->addCombo($cartCombo);
        if (session('cartError')) {
            return redirect()->route('cart')->with('failure', session('cartError'));
        }
        return redirect()->route('cart')->with('success');
    }
    

    // public function addComboToCart(Request $request){
    //     $combo = Combo::where('id', $request->comboId)->first();
    //     $sizes = json_decode($request->sizes, true);
    //     $combo_items = $combo->items;
    //     // Añadir Combo  al carrito de la sesión.
    //     $cartCombo = new CartCombo($combo, $sizes);
    //         $this->cartManager->addCombo($combo_items, $combo);

    //     //     // Chequear si en esta sesion, en este navegador, hay un usuario logueado. Si hay, persistir el carrito de la sesion a la base de datos
    //     //     if (Auth::check()) {
    //     //         $user = User::where('id', Auth::user()->id)->first();
    //     //         CartManager::storeOrUpdateInDatabase($user);
    //     //         $cart = Cart::where('user_id',$user->id)->first();
    //     //     }
    //     //     if (session('cartError')) {
    //     //         return redirect()->route('cart')->with('failure', session('cartError'));
    //     //     }
    //     $combo = Combo::where('id', $request->comboId)->first();
    //         // Añadir Item al carrito de la sesión.
    //         $cartCombo = new CartItem('combo', $combo);
    //         CartManager::addCombo($cartCombo);

    //         // Chequear si en esta sesion, en este navegador, hay un usuario logueado. Si hay, persistir el carrito de la sesion a la base de datos
    //         if (Auth::check()) {
    //             $user = User::where('id', Auth::user()->id)->first();
    //             CartManager::storeOrUpdateInDatabase($user);
    //             $cart = Cart::where('user_id',$user->id)->first();
    //         }
    //         if (session('cartError')) {
    //             return redirect()->route('cart')->with('failure', session('cartError'));
    //         }
    //     return redirect()->route('cart')->with('success');
    // }
    

    public function dropCart() {
        session()->forget('cart');
        $user = Auth::user();
        if ($user){
            $cart = Cart::where('user_id', $user->id);
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
