<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Counter extends Component
{
    public $stock;
    public $count = 0;
 
    #[On('change-livewire-component')]
    public function setStock($stock)
    {
        $this->count = 1;
        $this->stock = $stock;
        if ($this->stock == null) {
            $this->count = 0;
        }
    }
    public function increment()
    {
        if ($this->count < $this->stock){
            $this->count++;
        }
    }
 
    public function decrement()
    {
        if ($this->count > 1) {
            $this->count--;
        }
    }
 
    public function render()
    {
        return view('livewire.counter');
    }
}
