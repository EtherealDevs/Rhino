<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Product;
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
        $categories=Category::all();
        return view('admin.combos.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $items =serialize($request->items);
        // unserialize($items);
        Combo::create([
            'items'=> $items,
            'discount'=> $request->discount
        ]);
        return redirect()->route('admin.combos.index');
    }
}
