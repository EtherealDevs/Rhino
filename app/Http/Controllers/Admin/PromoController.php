<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        return view('admin.promos.index');
    }

    public function create()
    {
        return view('admin.promos.create');
    }
}
