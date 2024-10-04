<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Reviews::create([
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'content' => $validated['content'],
            'rating' => $validated['rating'],
        ]);

        return back()->with('success', 'Reseña guardada con éxito.');
    }
}
