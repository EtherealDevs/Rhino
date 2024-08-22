<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Contracts\Cache\Store;
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
        $sale=Sale::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'discount'=>$request->discount,
        ]);
        if($request->file('image')){
            $url = Storage::put('sales', $request->file('image'));
            $sale->images()->create([
                'url' => $url
            ]);
        }
        foreach($request->products as $product){
            SaleProduct::create([
                'sale_id'=>$sale->id,
                'product_id'=>$product,
            ]);
        }
        notify()->success('Creaste la promo con exito ⚡️');
        return redirect()->route('admin.sales.index');
    }

    public function edit(Sale $sale)
    {
        $categories= Category::all();
        return view('admin.sales.edit', compact('sale','categories'));
    }

    public function update(Request $request, Sale $sale)
    {
        $sale->update([
            'title'=>$request->title??$sale->title,
            'description'=>$request->description??$sale->description,
            'start_date'=>$request->start_date??$sale->start_date,
            'end_date'=>$request->end_date??$sale->end_date,
            'discount'=>$request->discount??$sale->discount,
        ]);
        if($request->file('image')){
            $url = Storage::put('sales', $request->file('image'));
            $sale->images()->update([
                'url' => $url
                ]);
            }
            if($request->products){
                $sale->products()->delete();
                foreach($request->products as $product){
                    SaleProduct::create([
                        'sale_id'=>$sale->id,
                        'product_id'=>$product,
                        ]);
                }
            }
            notify()->success('Actualizaste la promo con exito ⚡️');
        return redirect()->route('admin.sales.index');
    }

    // public function destroy(Sale $sale)
    // {
    //     Storage::delete($sale->images->first()->url);
    //     $sale->images()->delete();
    //     $sale->delete();
    //     return redirect()->back();
    // }

    static function destroy(Sale $sale)
    {
        Storage::delete($sale->images->first()->url);
        $sale->images()->delete();
        $sale->delete();

        notify()->success('Se borro la promo con exito ⚡️');
        return redirect()->back();
    }
}
