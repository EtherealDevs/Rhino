<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $sizes=Size::all();
        return view('admin.products.create',compact('sizes'));
    }

    public function store(Request $request)
    {
        Size::create([
            'name'=> $request->size,
            'sort_number'=>$request->sort_number
        ]);
        return redirect()->back();
    }

    public function show(Size $size)
    {
        //
    }

    public function edit(Size $size)
    {
        return view('admin.size.edit',compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $size->update([
            'name'=> $request->size,
            'sort_number'=>$request->sort_number
        ]);
        return redirect()->back();
    }

    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->back();
    }
}
