<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

use Livewire\Attributes\Reactive;

use App\Http\Validators\AddressValidator;
use App\Models\Province as ModelsProvince;
use App\Models\ZipCode as ModelsZipCode;
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

    #[Reactive]
    public $payment;

    public $original_total = 0;
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
    public $selectedMethod;

    protected $listeners = ['selectionChanged' => 'selectionChanged', 'updatedCity' => 'updateZipCode', 'updateZipCode' => 'updateZipCode', 'updatedSucursal' => 'calculateSendPrice', 'resetPrice' => 'resetPrice'];

    public function updateSendPrice($newPrice)
    {
        $this->sendPrice = $newPrice;
    }
    public function resetPrice()
    {
        $this->zip_code = null;
        $this->province = null;
        $this->city = null;
        $this->sucursal = null;
        $this->sendPrice = null;
    }


    public function mount($zip_code, $province = null, $city = null, $selectedMethod = null, $payment = null)
    {
        // Carga de dirección de usuario
        $addressValidator = new AddressValidator();

        if ($province != null) {
            $this->province = $province;
        };
        if ($city != null) {
            $this->city = $city;
        }
        if ($selectedMethod != null) {
            $this->selectedMethod = $selectedMethod;
        }

        $this->zip_code = $zip_code;
        $this->calculateCartItems();
        if ($this->zip_code != null) {
            $this->zip_code = $addressValidator->validateZipCode($zip_code);
            $this->calculateSendPrice();
        }
        if ($payment != null) {
            $this->payment = $payment;
            if ($this->payment == "transferencia" && $this->total != 0) {
                $this->total -= $this->total * 0.06;
            }
        }
    }
    #[On('updatedPayment')]
    public function updatedPayment($payment)
    {
        $this->payment = $payment;
            if ($this->payment == "transferencia" && $this->total != 0) {
                $this->total -= $this->total * 0.06;
            }
            else if ($this->payment == "mercado_pago")
            {
                $this->total = $this->original_total;
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
    #[On('selectionChanged')]
    public function selectionChanged($selection)
    {
        $this->selectedMethod = $selection;
    }

    #[On('updatedCity', 'updateZipCode')]
    public function updateZipCode($zip_code, $province = null, $city = null)
    {
        switch ($this->selectedMethod) {
            case 'domicilio':
                if ($zip_code != null && $province != null && $city != null) {
                $this->zip_code = $zip_code;
                $this->province = $province;
                $this->city = $city;
                $this->validate();
                $this->calculateSendPrice();
                }
                break;
            case 'sucursal':
                $this->zip_code = $zip_code;
                break;
        }
    }

    protected function calculateCartItems()
    {
        $cartService = new CartService();
        $props = $cartService->getCartItemsProperties();
        $this->total = $props['total'] ?? 0;
        $this->original_total = $props['total'] ?? 0;
        $this->itemCount = $props['count'] ?? 0;
    }
    #[On('updatedSucursal')]
    public function calculateSendPrice()
    {
        $shippingService = new ShippingService();
        $codigo = null;
        switch ($this->selectedMethod) {
            case 'domicilio':
                $codigo = config('app.delivery_service.sucursal_a_puerta');
                break;
            case 'sucursal':
                $codigo = config('app.delivery_service.sucursal_a_sucursal');
        }
        $codigo = (int) $codigo;
        $new_zip_code = ModelsZipCode::where('code', $this->zip_code)->first();
        $price = $shippingService->getShippingCosts($new_zip_code->code, $codigo);
        $this->sendPrice = $price;
    }

    public function render()
    {
        return view('livewire.resume', ['sendPrice' => $this->sendPrice]);
    }
}
