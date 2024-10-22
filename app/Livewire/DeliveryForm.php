<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;

use App\Http\Validators\AddressValidator;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\ZipCode as ModelsZipCode;
use App\Rules\ZipCode;
use App\Models\Address;
use App\Rules\Province as RulesProvince;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DeliveryForm extends Component
{
    public $addressModels;
    public $addressModel;
    public $selectedAddressId;
    public $user;
    #[Validate]
    public $name;

    #[Validate]
    public $last_name;

    #[Validate]
    public $phone_number;

    #[Validate]
    public $zip_code;

    #[Validate]
    public $province;

    public $zipCodeModels;
    public $provinceModels;
    public $cityModels;
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

    public $formattedNumber;

    // Nueva propiedad para manejar la visibilidad del modal
    public $showConfirmationModal = false;

    public $sucursales;
    public $sucursalesIds;
    public $sucursal = null;
    public $sucursalArray = null;

    #[Validate]
    public $selectedMethod;

    public function mount(User $user, $zip_code = null, $province = null, $city = null)
    {
        $this->selectedMethod = 'domicilio';
        $this->zipCodeModels = ModelsZipCode::all();
        $this->provinceModels = Province::all();
        $this->cityModels = City::all();

        $this->user = $user;
          // Obtener las direcciones del usuario autenticado
          $addresses = Address::where('user_id', Auth::id())->get();
          if ($addresses->isNotEmpty()) {
              $this->addressModels = Address::where('user_id', Auth::id())->get()->load('province', 'city', 'zipCode');
    
              $this->selectedAddressId = $this->addressModels->first()->id;
              $this->addressModel = $this->addressModels->where('id', $this->selectedAddressId)->first();
              $this->updatedSelectedAddressId($this->selectedAddressId);
          }
        // if ($zip_code != null) {
        //     $this->zip_code = $zip_code;
        //     $this->updatedZipCode($this->zip_code);
        // }
        // if ($city != null) {
        //     $this->city = $city;
        //     $this->updatedCity($this->city);
        // }
        
    }


    public function rules()
    {

        return [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string|max_digits:10|min_digits:10',
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode],
            'province' => ['required', 'integer', new RulesProvince],
            'city' => 'required|integer',
            'address' => 'required|string',
            'street' => 'required|string',
            'number' => 'string|nullable',
            'department' => 'string|nullable',
            'street1' => 'string|nullable',
            'street2' => 'string|nullable',
            'observation' => 'string|nullable'
        ];
    }
    public function formatPhoneNumber()
    {
        // Format the phone number as 1234-123456
        $cleaned = preg_replace('/\D/', '', $this->phone_number); // Remove non-digits
        $this->formattedNumber = strlen($cleaned) >= 4
            ? substr($cleaned, 0, 4) . '-' . substr($cleaned, 4)
            : $cleaned;
    }
    public function updatedFormattedNumber($phone_number)
    {
        $string = preg_replace("/[^a-zA-Z0-9]+/", "", $phone_number);
        $this->phone_number = $string;
        $this->validateOnly('phone_number');
    }

    public function updatedZipCode($zipCode)
    {
        $addressValidator = new AddressValidator();
        $addressValidator->validateZipCode($zipCode);
        
        $zipCodeModel = $this->zipCodeModels->where('code', '=', $zipCode)->first();
        $this->province = $zipCodeModel->province->name;
        $this->selectedCity = null; // Reset city selection when province changes
        $this->city = null; // Reset city when province changes
        $this->cities = $this->cityModels->where('province_id', $zipCodeModel->province->id)->sortBy('name');
    }

    public function updatedSelectedProvince($provinceName)
    {
        $provinceId = $this->provinceModels->where('name', '=', $provinceName)->first()->id; // Asegúrate de obtener el ID correcto
        $this->cities = $this->cityModels->where('province_id', $provinceId)->sortBy('name');
        $this->selectedCity = null; // Reset city selection when province changes
        $this->city = null; // Reset city when province changes
    }

    public function updatedCity($cityId)
    {
        $this->dispatch('updatedCity', zip_code: $this->zip_code, province: $this->province, city: $this->city);
        $this->city = $cityId;
    }
    public function updatedSelectedAddressId($addressId)
    {
        $this->addressModel = $this->addressModels->where('id', $addressId)->first()->load('province', 'city', 'zipCode');
        $this->fill([
            'name' => $this->addressModel->name,
            'last_name' => $this->addressModel->last_name,
            'phone_number' => $this->addressModel->phone_number,
            'address' => $this->addressModel->address,
            'zip_code' => $this->addressModel->zipCode->code,
            'street' => $this->addressModel->street,
            'number' => $this->addressModel->number,
            'department' => $this->addressModel->department,
            'street1' => $this->addressModel->street1,
            'street2' => $this->addressModel->street2,
            'observation' => $this->addressModel->observation,
        ]);
        $this->formatPhoneNumber();
        $this->updatedFormattedNumber($this->addressModel->phone_number);
        $this->updatedZipCode($this->addressModel->zipCode->code);
        $this->updatedSelectedProvince($this->addressModel->province->name);
        $this->selectedCity = $this->addressModel->city->id;
        $this->city = $this->addressModel->city->id;
    }

    // Nuevo método para rellenar el formulario con datos del cliente
    // public function fillFormWithUserData()
    // {
    //     $this->fill($this->user->only('name', 'last_name', 'phone_number', 'address', 'street', 'number', 'department', 'street1', 'street2', 'observation'));

    //     if ($this->this->addressModel) {
    //         $this->zip_code = $this->this->addressModel->zipCode->code;
    //         $this->province = $this->this->addressModel->province->name;
    //         $this->city = $this->this->addressModel->city_id;
    //         $this->cities = City::where('province_id', $this->this->addressModel->province_id)->get()->sortBy('name');
    //     }
    // }

    // public function confirmFill()
    // {
    //     $this->fillFormWithUserData();
    //     $this->showConfirmationModal = false; // Oculta el modal después de confirmar
    // }

    public function render()
    {
        return view('livewire.delivery-form', [
            'showConfirmationModal' => $this->showConfirmationModal,
            'addresses' => $this->addressModels,
        ]);
    }
}
