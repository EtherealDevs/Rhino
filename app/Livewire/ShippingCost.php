<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Http\Cart\CartManager;
use App\Http\Controllers\DeliveryServiceController;
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
    public $user;
    #[Validate]
    public $zip_code;

    #[Validate]
    public $province;
    public $total=0;

    public $selectedProvince = null;
    public $selectedCity = null;
    public $sucursal = null;
    public $cities = [];
    public $volume;
    public $weigth;
    public $productItems;
    public $cartItems;


    public $city;
    public $sendPrice=0;
    #[Validate]
    public $address;
    // ShippingCost.php
    public function updatedSendPrice($house)
    {
        $code = Province::where('name',$this->province)->first();
        $code = ModelsZipCode::where('province_id', $code->id)->first();
        $params= ['operativa'=>64665,'peso'=>1,'volumen'=>1,'cP'=>$this->zip_code,'cPDes'=>$code->code,'cantidad'=>1,'valor'=>$this->total];
        $price = DeliveryServiceController::obtenerTarifas($params);
        $this->sendPrice = $price;
        $this->total += $this->sendPrice;
    }



    public function mount(User $user)
    {

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
        $this->productItems = ProductItem::all();
        if (Auth::check()) {
            $cartModel = Cart::where('user_id', Auth::user()->id)->first();
            $this->cartItems = CartManager::getCartContents($cartModel);
        } else {
            $this->cartItems = CartManager::getCartContents();
        }
        if(isset($this->cartItems)){
            foreach ($this->cartItems as $item) {
                $itemAmount = $item['amount'];
                $discount = $item['item']->product->sale->sale->discount ?? $item['item']->product->combo->combo->discount ??0;
                $price = $item['item']->price();
                $priceDiscount = ($price * $discount) / 100;
                $this->total += ($price - $priceDiscount) * $itemAmount;
                $this->volume += $item['item']->product->volume;
                $this->weigth += $item['item']->product->weigth;
            }
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

        return view('livewire.shipping-cost');
    }
}
