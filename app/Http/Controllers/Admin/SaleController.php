<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    public function index()
    {
        $sales= Sale::all();
       /*  $categories= Category::all(); */
        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();
        return view('admin.sales.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|required|unique:sales',
            'description' => 'alpha_num|string|nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|'
        ]);
        $sale=Sale::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'discount'=>$request->discount,
        ]);
        if($request->file('image')){
            $url = Storage::put('sales', $request->file('image'));
            $sale->image()->create([
                'url' => $url
            ]);
        }
        foreach($request->products as $product){
            SaleProduct::create([
                'sale_id'=>$sale->id,
                'product_id'=>$product,
            ]);
        }
        return redirect()->route('admin.sales.index');
    }

    public function edit(Sale $sale)
    {
        return view('admin.sales.edit', compact('sale'));
    }

    public function update(Request $request, Sale $sale)
    {
        $sale->Sale::update([
            'title'=>$request->title,
            'description'=>$request->description,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'discount'=>$request->discount,
        ]);
        foreach($request->products as $product){
            $sale->products->update([
                'sale_id'=>$sale->id,
                'product_id'=>$product->id,
            ]);
        }
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->back();
    }
}
