<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductsSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\StockNotify;
use App\Models\User;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.stock.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stock.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size_id' => 'required|exists:sizes,id',
            'stock' => 'required|integer|min:0',
        ]);

        $product_size = DB::table('products_sizes')
            ->where('product_item_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->first();

        DB::table('products_sizes')
            ->where('product_item_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->update([
                'stock' => $request->stock,
            ]);

        if ($request->stock <= 5) {
            $this->notifyLowStock($request);
        }

        return redirect()->route('admin.stock.index');
    }

    /**
     *
     *
     * @param Request $request
     */
    public function without()
    {
        // Filtrar productos con stock total igual a cero en todos los tamaños
        $products = Product::whereDoesntHave('items.sizes', function ($query) {
            $query->where('stock', '>', 0);
        })->with('items.sizes.color')->get();

        return view('admin.stock.without', compact('products'));
    }

    protected function notifyLowStock(Request $request)
    {
        $product = Product::find($request->product_id);
        $admin = User::role('admin')->first();

        if ($product) {
            if ($admin) {

                $admin->notify(new StockNotify($product, $request));
            }
        }
    }
}
