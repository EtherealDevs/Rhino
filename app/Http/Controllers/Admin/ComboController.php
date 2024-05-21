<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    public function index()
    {
       /*  $categories= Category::all(); */
        return view('admin.combos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.combos.create');
    }
}
