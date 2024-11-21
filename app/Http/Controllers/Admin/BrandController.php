<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        Brand::create([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return redirect()->route('admin.brands.index');
    }

    public function show(Brand $brand)
    {}

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $brand->update([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return redirect()->route('admin.brands.index');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->back();
    }
}
