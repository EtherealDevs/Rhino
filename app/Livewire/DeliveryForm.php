<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\ZipCode as ModelsZipCode;
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

    #[Validate]
    public $province;

    public $selectedProvince = null;
    public $selectedCity = null;
    public $cities = [];


    public $city;

    #[Validate]
    public $address;

    #[Validate]
    public $street;

    #[Validate]
    public $number;

    #[Validate]
    public $department;

    #[Validate]
    public $street1;

    #[Validate]
    public $street2;

    #[Validate]
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
            $this->province = $user->address->province->name;
            $this->city = $user->address->city_id;
            $this->fill(
                $user->address->only('name', 'last_name', 'address', 'street', 'number', 'department', 'street1', 'street2', 'observation'),
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

    public function updatedZipCode($zipCode)
    {
        $zipCodeModel = ModelsZipCode::where('code', '=', $zipCode)->first();
        $this->province = $zipCodeModel->province->name;
        $this->selectedCity = null; // Reset city selection when province changes
        $this->city = null; // Reset city when province changes
        $this->cities = City::where('province_id', $zipCodeModel->province->id)->get()->sortBy('name');
    }
    public function updatedSelectedProvince($provinceName)
    {
        $provinceId = Province::where('name', '=', $provinceName);
        $this->province = $provinceId;
        $this->cities = City::where('province_id', $provinceId)->get()->sortBy('name');
        $this->selectedCity = null; // Reset city selection when province changes
        $this->city = null; // Reset city when province changes

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
