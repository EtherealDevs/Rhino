<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductsSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
       $products=Product::all();
        return view('admin.stock.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stock.create');
    }

    public function store(Request $request){
        $product_size= DB::table('products_sizes')->where('product_item_id',$request->product_id)->where('size_id',$request->size_id)->first();
        $product_size->update([
            'stock' => $request->stock,
        ]);
        return redirect()->route('admin.stock.index');
    }
}
