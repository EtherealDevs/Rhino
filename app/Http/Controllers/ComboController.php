<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComboController extends Controller
{
    public function index()
    {
        return view('combos.index');
    }

    public function show()
    {
        return view('combos.show');
    }
}
