<?php

namespace App\Livewire;

use App\Models\Review;  // Importamos el modelo Review
use App\Models\Reviews;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RatingStars extends Component
{
    public $products = [];
    public $selectedProduct;
    public $reviewText;
    public $value;

    // Método para cargar productos desde la base de datos
    public function mount() {
        // Cargar productos desde la base de datos
        $this->loadProducts();
    }

    public function loadProducts()
    {
        // Aquí cargamos todos los productos desde la base de datos
        $this->products = Product::all(); 
    }

    public function submitReview()
    {
        // Validación de los datos
        $this->validate([
            'selectedProduct' => 'required|exists:products,id',
            'value' => 'required|integer|min:1|max:5',
            'reviewText' => 'required|string|max:500',
        ]);

        // Crear la reseña en la base de datos
        Reviews::create([
            'user_id' => Auth::id(), // ID del usuario autenticado
            'product_id' => $this->selectedProduct,
            'rating' => $this->value,
            'content' => $this->reviewText,
        ]);

        // Puedes resetear los valores si lo deseas
        $this->reset(['selectedProduct', 'reviewText', 'value']);
        // Indicar que la reseña fue enviada
        $this->dispatchBrowserEvent('review-submitted');
    }

    public function render()
    {
        return view('livewire.rating-stars');
    }
}
