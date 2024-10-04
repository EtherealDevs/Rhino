<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class UpdateAdressUser extends Component
{
    public $addresses;
    public $selectedAddressId;

    // Este método se ejecuta cuando el componente es cargado
    public function mount()
    {
        // Obtener las direcciones del usuario autenticado
        $this->addresses = Address::where('user_id', Auth::id())->get();

        // Inicialmente, no seleccionamos ninguna dirección
        $this->selectedAddressId = null;
    }

    public function render()
    {
        return view('livewire.profile.update-adress-user', [
            'addresses' => $this->addresses,
        ]);
    }

    public function updateAddressInformation()
    {
        // Lógica para manejar la dirección seleccionada por el usuario
        if ($this->selectedAddressId) {
            // Obtener la dirección seleccionada
            $address = Address::find($this->selectedAddressId);

            // Aquí puedes realizar alguna acción con la dirección seleccionada
        }

        // Emitir un mensaje de éxito
        $this->emit('saved');
    }
}
