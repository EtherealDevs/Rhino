<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Http\Cart\CartManager;
use App\Models\Cart;
use App\Models\ProductItem;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\ZipCode as ModelsZipCode;
use App\Rules\ZipCode;
use Livewire\Attributes\Validate;

class ShippingCost extends Component
{
    #[Validate]
    public $zip_code;

    #[Validate]
    public $province;

    public $selectedProvince = null;
    public $selectedCity = null;
    public $sucursal = null;
    public $cities = [];


    public $city;
    public $sendPrice=0;
    #[Validate]
    public $address;
    // ShippingCost.php
    public function updatedSendPrice($house)
    {
        $code = Province::where('name',$this->province)->first();
        $response = Http::withHeaders([
            'x-rapidapi-host' => env('RAPI_API_HOST'),
            'x-rapidapi-key' => env('RAPI_API_KEY'),
        ])->get(env('RAPI_API_URL').'/calcularPrecio', [
            'cpOrigen' => '3400', // Código postal de origen fijo
            'cpDestino' => $this->zip_code,
            'provinciaOrigen' => 'AR-W',
            'provinciaDestino' => $code->code,
            'peso' => 10,
        ]);

        // Manejar posibles errores en la respuesta
        if ($response->ok()) {
            if ($house){
                $this->sendPrice = $response->json()['paqarClasico']['aDomicilio'] ?? 'No disponible';
            }else{
                $this->sendPrice = $response->json()['paqarClasico']['aSucursal'] ?? 'No disponible';
            }
        }
    }

    

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
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode],
            'province' => 'required',
            'city' => 'required',
            'address' => 'required|string',
        ];
    }

    public function updatedZipCode($zipCode)
    {
        $this->validate([
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode]
        ]);
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

    public function updatedSucursal(){
        $this->updatedSendPrice(false);
    }
    public function updatedCity($cityId)
    {
        $this->city = $cityId;
        $this->updatedSendPrice(true);

    }

    public function render()
    {
        $productItems = ProductItem::all();
        if (Auth::check()) {
            $cartModel = Cart::where('user_id', Auth::user()->id)->first();
            $cartItems = CartManager::getCartContents($cartModel);
        } else {
            $cartItems = CartManager::getCartContents();
        }

        return view('livewire.shipping-cost',  ['productItems' => $productItems, 'cartItems' => $cartItems]);
    }
}
