<?php


namespace App\Livewire;

use App\Http\Controllers\DeliveryServiceController;
use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\City;
use App\Models\Province;
use App\Models\ZipCode as ModelsZipCode;
use App\Rules\ZipCode;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Http\Validators\AddressValidator;
use App\Rules\Sucursales;
use App\Services\CartService;
use App\Services\ShippingService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CheckoutConfig extends Component
{
    public $house=0;
    public $addressModels;
    public $addressModel;

    public $user;
    #[Validate]
    public $zip_code;

    #[Validate]
    public $province;
    public $total = 0;

    public $selectedProvince = null;
    public $selectedCity = null;
    public $sucursal = null;
    public $cities = [];
    public $city;

    // Selected method of delivery (domicilio, retiro sucursal, retiro en tienda)
    #[Validate]
    public $selectedMethod;

    public $sendPrice = 0;

    public $alias;
    public $cbu;
    public $holder_name;
    public $sucursales;
    public $sucursalesIds;

    public function mount()
    {
        $this->selectedMethod = 'domicilio';
    }

    public function rules()
    {
        return [
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode],
            'province' => 'required',
            'city' => 'required',
            'sucursal' => [Rule::in($this->sucursalesIds)],
            'selectedMethod' => ['string','alpha', Rule::in(['domicilio', 'sucursal', 'retiro'])]
        ];
    }
    public function canGoToNextStep()
    {
        switch ($this->selectedMethod) {
            case 'domicilio':
                $this->validateOnly('zip_code');
                $this->validateOnly('province');
                $this->validateOnly('city');
                return true;
                break;
            case 'sucursal':
                $this->validateOnly('zip_code');
                $this->validateOnly('sucursal');
                return true;
                break;
            case'retiro':
                return true;
                break;
            default:
                # code...
                break;
        }
    }
    #[On('selectionChanged')] 
    public function setSelected($selection)
    {
        $this->selectedMethod = $selection;
        $this->validateOnly('selectedMethod');
    }

    public function updatedSelectedProvince($provinceName)
    {
        $provinceId = Province::where('name', '=', $provinceName);
        $this->province = $provinceId;
        $this->cities = City::where('province_id', $provinceId)->get()->sortBy('name');
        $this->selectedCity = null; // Reset city selection when province changes
        $this->city = null; // Reset city when province changes
    }

    public function updatedZipCode($zipCode)
    {
        $this->validateOnly('zip_code');
        $addressValidator = new AddressValidator();
        $shippingService = new ShippingService();
        $addressValidator->validateZipCode($zipCode);

        $zipCodeModel = ModelsZipCode::where('code', '=', $zipCode)->first()->load('province', 'province.cities');
        $this->province = $zipCodeModel->province->name;
        $this->selectedCity = null; // Reset city selection when province changes
        $this->city = null; // Reset city when province changes
        $this->cities = $zipCodeModel->province->cities->sortBy('name');
        $this->sucursales = $shippingService->getSucursales($zipCode);
        $this->sucursalesIds = [];
        foreach ($this->sucursales as $sucursal) {
            $this->sucursalesIds[] = $sucursal['IdCentroImposicion'];
        }

    }

    // public function updatedSucursal()
    // {
    //     $this->updatedSendPrice(false);
    // }

    public function updatedCity($cityId)
    {
        $this->dispatch('updatedCity', zip_code: $this->zip_code, province: $this->province, city: $this->city)->to(Resume::class);
        $this->city = $cityId;
    }

    public function render()
    {
        return view('livewire.checkout-config', ['zip_code' => $this->zip_code]);
    }
}