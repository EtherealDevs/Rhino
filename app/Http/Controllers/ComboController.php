<?php

namespace App\Http\Controllers;

use App\Livewire\ShowCombo;
use App\Models\Combo;
use App\Models\Size;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    public function index()
    {
        $combos = Combo::all();
        return view('combos.index', compact('combos'));
    }

    public function show(Combo $combo)
    {
        return view('combos.show', compact('combo'));
    }
}
