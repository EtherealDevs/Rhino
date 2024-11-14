<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class Sidebar extends Component
{
    public $categories;
    public $sizes;

    public function mount($sizes)
    {
        // Obtener todas las categorías, pero excluyendo las categorías padres que no tengan hijos
        $this->categories = Category::with('children') // Trae las categorías con sus hijos
            ->whereNull('parent_id') // Filtra solo categorías padres
            ->get();
        $this->sizes = $sizes;
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
