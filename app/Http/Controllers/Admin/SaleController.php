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
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function index()
    {
        $sales= Sale::all();
       /*  $categories= Category::all(); */
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $categories= Category::all();
        return view('admin.sales.create', compact('categories'));
    }


public function store(Request $request)
{
    // Validación de los datos de entrada
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'discount' => 'required|numeric|min:0',
        'products' => 'required|array|min:1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Crear la venta después de la validación
    $sale = Sale::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'start_date' => $validatedData['start_date'],
        'end_date' => $validatedData['end_date'],
        'discount' => $validatedData['discount'],
    ]);

    // Manejo de la carga de imágenes
    if ($request->file('image')) {
        $url = Storage::put('images/sales', $request->file('image'));
        $sale->images()->create([
            'url' => $url
        ]);
    }

    // Manejo de los productos asociados a la venta
    foreach ($validatedData['products'] as $product) {
        SaleProduct::create([
            'sale_id' => $sale->id,
            'product_id' => $product,
        ]);
    }

    session()->flash('message', 'Se creo la promo con éxito ⚡️');
    return redirect()->route('admin.sales.index');
}


    public function edit(Sale $sale)
    {
        $categories= Category::all();
        return view('admin.sales.edit', compact('sale','categories'));
    }

    public function update(Request $request, Sale $sale)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount' => 'required|numeric|min:0',
            'products' => 'nullable|array|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Actualizar la venta después de la validación
        $sale->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'discount' => $validatedData['discount'],
        ]);

        // Manejo de la carga de imágenes
        if ($request->file('image')) {
            $url = Storage::put('sales', $request->file('image'));
            if ($sale->images()->exists()) {
                $sale->images()->update([
                    'url' => $url
                ]);
            } else {
                $sale->images()->create([
                    'url' => $url
                ]);
            }
        }

        // Manejo de los productos asociados a la venta
        if ($request->products) {
            $sale->products()->delete(); // Elimina los productos existentes relacionados con la venta
            foreach ($validatedData['products'] as $product) {
                SaleProduct::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product,
                ]);
            }
        }

        session()->flash('message', 'Se editó la promo con éxito ⚡️');
        return redirect()->route('admin.sales.index');
    }


    // public function destroy(Sale $sale)
    // {
    //     Storage::delete($sale->images->first()->url);
    //     $sale->images()->delete();
    //     $sale->delete();
    //     return redirect()->back();
    // }

    public function destroy(Sale $sale)
{
    // Verifica si la venta tiene imágenes y elimina la primera
    if ($sale->images()->exists()) {
        Storage::delete($sale->images->first()->url);
        $sale->images()->delete(); // Elimina todas las imágenes asociadas
    }

    $sale->delete(); // Elimina la promoción
    session()->flash('message', 'Se borró la promo con éxito ⚡️');

    return redirect()->back();
}

}
