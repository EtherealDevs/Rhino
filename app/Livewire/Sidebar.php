<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public $categories;
    public $sizes;
    public function mount($categories,$sizes){
        $this->categories = $categories;
        $this->sizes = $sizes;
    }
    public function render()
    {
        return view('livewire.sidebar');
    }
}
