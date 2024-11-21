<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Color::create([
            'name' => $request->name,
            'color' => $request->color,
        ]);
        return redirect()->back();
    }

    public function show(Color $color)
    {
        //
    }

    public function edit(Color $color)
    {

    }

    public function update(Request $request, Color $color)
    {
        $color->update([
            'name' => $request->name,
            'color' => $request->code,
        ]);
        return redirect()->back();
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->back();
    }
}
