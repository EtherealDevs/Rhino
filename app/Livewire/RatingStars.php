<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reviews;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RatingStars extends Component
{
    public $productId;
    public $rating;
    public $reviewText;

    public $product; // Producto específico

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'reviewText' => 'required|string|max:500',
    ];

    public function submitReview()
    {
        $this->validate();

        Reviews::create([
            'product_id' => $this->productId,
            'user_id' => Auth::id(),
            'content' => $this->reviewText,
            'rating' => $this->rating,
        ]);

        $this->dispatchBrowserEvent('review-submitted');
        $this->reset(['rating', 'reviewText']);
    }

    public function render()
    {
        return view('livewire.rating-stars');
    }
}
