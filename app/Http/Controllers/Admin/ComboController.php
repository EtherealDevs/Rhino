<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Combo_items;
use App\Models\Product;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    public function index()
    {
        $combos = Combo::all();
        return view('admin.combos.index', compact('combos'));
    }

    public function create()
    {
        $categories=Category::all();
        return view('admin.combos.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $combo=Combo::create([
            'discount'=> $request->discount
        ]);
        foreach($request->items as $item){
            Combo_items::create([
                'combo_id'=> $combo->id,
                'product_id'=> $item,
            ]);
        }
        return redirect()->route('admin.combos.index');
    }

    public function edit(Combo $combo)
    {
        $categories=Category::all();
        return view('admin.combos.edit',compact('categories','combo'));
    }

    public function update(Request $request, Combo $combo)
    {
        $combo->update([
            'discount'=> $request->discount??$combo->discount
        ]);
        $combo->items()->delete();
        foreach($request->items as $item){
            Combo_items::create([
                'combo_id'=> $combo->id,
                'product_id'=> $item,
            ]);
        }
        return redirect()->route('admin.combos.index');
    }

    public function destroy(Combo $combo)
    {
        $combo->items()->delete();
        $combo->delete();
        return redirect()->route('admin.combos.index');
    }
}
