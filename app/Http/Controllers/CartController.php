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
use App\Http\Validators\CartValidator;
use App\Models\Size;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

    public function index(){
        $productItems = ProductItem::all();
        $cartItems = $this->cartManager->getCartContents();
        [$combos, $items] = $cartItems->partition(function ($item) {
            return $item->type == CartCombo::DEFAULT_TYPE;
        });
        $cartTotal = $this->cartManager->getCarttotal();

        if (Auth::user() != null) {
            if (Auth::user()->cart != null) {
                if ($cartItems->isNotEmpty()) {
                    $cartValidator = new CartValidator(Auth::user()->cart);
                    $failedValidation = $cartValidator->validateCart();
                    if ($failedValidation) {
                            // Set session flash message
                            session()->flash('cartError', 'Se eliminaron del carrito algunos productos que ya no estaban disponibles.');
                    }
                }
            }
        }

        return view('cart.index', ['combos' => $combos, 'items' => $items, 'cartTotal' => $cartTotal]);
    }


    public function addToCart(Request $request)
    {
        $request->validate([
            'size' => 'required'
        ]);
        // Decode the item and size from the request parameters
        $size = json_decode($request->size);
        if (is_null($size)) {
            $size = $request->size;
        }
        $quantity = $request->quantity;
        // Retrieve the product item from the database
        $item = ProductItem::where('id', $request->item)->first();
        // If the product item is not found, throw an exception
        if (!$item) {
            throw new Exception('Product item not found');
        }
        // Create a new cart item
        $cartItem = new CartItem($item, $size, $quantity);
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
        $validator = Validator::make(['cartItemId' => $request->cartItemId], [
            'cartItemId' =>'required|string|alpha_num'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $this->cartManager->removeItem($request->cartItemId);

        return redirect()->route('cart')->with('success');
    }
    public function updateFromCart(Request $request)
    {
        $modes = ['add', 'subtract', 'update'];
        $request->validate([
            'mode' => ['required', Rule::in($modes)]
        ]);

        $quantity = $request->quantity != null ? $request->quantity : 1;
        $cartItemId = $request->cartItemId;
        //add, subtract, update
        $mode = $request->mode;
        $this->cartManager->updateQuantity($cartItemId, $mode, $quantity);
        return redirect()->route('cart');
    }
    public function addComboToCart(Request $request)
    {
        $comboIds = Combo::getAllComboIds();
        $sizesToValidate = ['sizes' => json_decode($request->sizes, true)];
        $availableSizes = Size::getSizesNames();
        $rules = [
            'sizes.*' => Rule::in($availableSizes),
        ];
        $validator = Validator::make($sizesToValidate, $rules);
        if ($validator->fails()) {
            return redirect()->back();
        }
        $request->validate([
            'comboId' => ['required', 'numeric', Rule::in($comboIds)]
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

    public function dropCart() {
        // Cambiar despues. CartItem || CartCombo :: DEFAULT_TYPE
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
