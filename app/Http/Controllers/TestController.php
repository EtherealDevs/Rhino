<?php

namespace App\Http\Controllers;

use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        $user = User::first();
        $item = ProductItem::first();
        dd($item->users());
        dd($user->items());
        dd($user->pivot);
    }
}
