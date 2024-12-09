<?php

namespace App\Livewire;

use Livewire\Attributes\On; 
use Livewire\Component;

class HandleComboSizes extends Component
{
    public array $sizesArray;
    public string $jsonSizes;
    #[On('updatedSize')] 
    public function updateSizeArray($size_array)
    {
        if (count($this->sizesArray) === 0) {
            $this->sizesArray = $size_array;
        }
        else
        {
            foreach ($size_array as $key => $value) {
                    $this->sizesArray[$key] = $value;
            }
        }
        $this->jsonSizes = json_encode($this->sizesArray);
    }
    public function render()
    {
        return view('livewire.handle-combo-sizes');
    }
}
