<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\User;
use App\Rules\ZipCode;
use Livewire\Component;
use Livewire\Attributes\Validate;

class DeliveryForm extends Component
{
    public $user;
    #[Validate]
    public $name;

    #[Validate]
    public $last_name;

    #[Validate]
    public $zip_code;

    #[Validate('required')]
    public $province;

    public $selectedProvince = null;
    public $selectedCity = null;
    public $cities = [];


    public $city;
    public $address;
    public $street;
    public $number;
    public $department;
    public $street1;
    public $street2;
    public $observation;
    public function mount(User $user)
    {
        $this->user = $user;
        
 
        $this->fill( 
            $user
        );
        if ($user->address != null) {
            $this->zip_code = $user->address->zipCode->code;
            $this->cities = City::where('province_id', $user->address->province->id)->get()->sortBy('name');
            $this->selectedProvince = $user->address->province_id;
            $this->province = $user->address->province_id;
            $this->city = $user->address->city_id;
            $this->fill(
                $user->address->only('address', 'street', 'number', 'department', 'street1', 'street2', 'observation'),
            );
        }
    }
    public function rules()
    {
        return [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode],
            'province' => 'required',
            'city' => 'required',
            'address' => 'required|string',
            'street' => 'required|string',
            'number' => 'string|nullable',
            'department' => 'string|nullable',
            'street1' => 'string|nullable',
            'street2' => 'string|nullable',
            'observation' => 'string|nullable',
        ];
    }

    public function updatedSelectedProvince($provinceId)
    {
        $this->province = $provinceId;
        $this->cities = City::where('province_id', $provinceId)->get()->sortBy('name');
        $this->selectedCity = null; // Reset city selection when state changes

    }
    public function updatedCity($cityId)
    {
        $this->city = $cityId;

    }

    public function render()
    {
        return view('livewire.delivery-form');
    }
}
