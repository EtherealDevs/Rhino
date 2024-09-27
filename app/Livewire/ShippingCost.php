<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Http\Cart\CartManager;
use App\Http\Cart\SessionCartManager;
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
    protected $cartManager;
    protected $cartContents;

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

    public $itemCount;

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
        if (Auth::check()) 
        {
            $this->cartManager = new CartManager();
        }
        else 
        {
            $this->cartManager = new SessionCartManager();
        }
        $this->cartItems = $this->cartManager->getCartContents();

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
        
        if($this->cartItems->isNotEmpty()){
            foreach ($this->cartItems as $item) {
                $itemModel = ProductItem::find($item->item_id);
                $itemQuantity = $item->quantity;
                $discount = $itemModel->product->sale->sale->discount ?? 0;
                $price = $itemModel->price();
                $priceDiscount = ($price * $discount) / 100;
                $this->total += ($price - $priceDiscount) * $itemQuantity;
                $this->volume += $itemModel->product->volume;
                $this->weigth += $itemModel->product->weigth;
                $this->itemCount = $this->cartManager->countItems();
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
