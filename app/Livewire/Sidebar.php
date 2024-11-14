<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class Sidebar extends Component
{
    public $categories;
    public $sizes;

    public function mount($categories, $sizes)
    {
        // Filtrar categorías con parent_id no nulo
        $this->categories = Category::whereNotNull('parent_id')->get(); // Filtra categorías que tienen parent_id no nulo
        $this->sizes = $sizes;
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
