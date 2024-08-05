<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showCheckoutDeliveryPage()
    {
        $user = User::where('id', auth()->user()->id)->with('address')->first();
        return view('checkout.delivery', ['user' => $user]);
    }
    public function showCheckoutPaymentPage()
    {
        dd(auth()->user());
        return view('checkout.payment');
    }
}
