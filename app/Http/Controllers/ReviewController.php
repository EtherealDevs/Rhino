<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;

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
            'product_id' => $validated['product_id'],
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'rating' => $validated['rating'],
        ]);

        return redirect()->back()->with('success', '¡Gracias por tu reseña!');
    }
}
