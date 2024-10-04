<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Http\Validators\AddressValidator;
use App\Rules\Province;
use App\Rules\ZipCode;
use Livewire\Attributes\Validate;
use App\Services\CartService;
use App\Services\ShippingService;

class Resume extends Component
{
    #[Validate]
    public $zip_code;

    #[Validate]
    public $province;

    public $total = 0;

    public $sucursal = null;
    public $cities = [];

    public $itemCount;

    public $city;

    // ShippingCost.php
    public $alias;
    public $cbu;
    public $holder_name;

    public $sendPrice;

    // protected $listeners = ['sendPriceUpdated' => 'updateSendPrice', 'updateZipCode'];

    public function updateSendPrice($newPrice)
    {
        $this->sendPrice = $newPrice;
    }


    public function mount($zip_code, $province = null, $city = null)
    {
        // Carga de dirección de usuario
        $addressValidator = new AddressValidator();

        if ($province != null) {
            $this->province = $province;
        };
        if ($city != null) {
            $this->city = $city;
        }

        $this->zip_code = $zip_code;

        $this->calculateCartItems();
        if ($this->zip_code != null) {
            $this->zip_code = $addressValidator->validateZipCode($zip_code);
            $this->calculateSendPrice();
        }
    }
    public function rules()
    {

        return [
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode],
            'province' => ['required', new Province],
            'city' => 'required|numeric',
        ];
    }

    #[On('updatedCity')]
    public function updateZipCode($zip_code, $province, $city)
    {
        $this->zip_code = $zip_code;
        $this->province = $province;
        $this->city = $city;
        $this->validate();
        $this->calculateSendPrice();
    }

    protected function calculateCartItems()
    {
        $cartService = new CartService();
        $props = $cartService->getCartItemsProperties();
        $this->total = $props['total'] ?? 0;
        $this->itemCount = $props['count'] ?? 0;
    }

    protected function calculateSendPrice()
    {
        $shippingService = new ShippingService();
        $price = $shippingService->getShippingCosts($this->zip_code);
        $this->sendPrice = $price;
    }

    public function render()
    {
        return view('livewire.resume', ['sendPrice' => $this->sendPrice]);
    }
}
