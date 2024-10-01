<?php


namespace App\Livewire;

use Livewire\Component;

use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\ZipCode as ModelsZipCode;
use App\Rules\ZipCode;
use Livewire\Attributes\Validate;
use App\Http\Controllers\DeliveryServiceController;
use App\Models\TransferInfo;
use App\Models\ProductItem;
use App\Http\Cart\CartManager;
use App\Http\Cart\SessionCartManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Cart\CartCombo;
use App\Http\Cart\CartItem;
use App\Models\Cart;

class CheckoutConfig extends Component
{
    protected $cartManager;
    protected $cartContents;

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
    public $itemCount;
    public $productItems;
    public $cartItems;

    public $volume;
    public $weight;
    public $sendPrice = 0;
    #[Validate]
    public $address;

    public $alias;
    public $cbu;
    public $holder_name;


    public function rules()
    {
        return [
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode],
            'province' => 'required',
            'city' => 'required',
            'address' => 'required|string',
        ];
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
        $this->validate([
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode]
        ]);
        $zipCodeModel = ModelsZipCode::where('code', '=', $zipCode)->first();
        $this->province = $zipCodeModel->province->name;
        $this->selectedCity = null; // Reset city selection when province changes
        $this->city = null; // Reset city when province changes
        $this->cities = City::where('province_id', $zipCodeModel->province->id)->get()->sortBy('name');
    }

    public function updatedSendPrice($house)
    {
        $code = Province::where('name', $this->province)->first();
        $code = ModelsZipCode::where('province_id', $code->id)->first();
        $params = ['operativa' => 64665, 'peso' => $this->weight, 'volumen' => $this->volume, 'cP' => 3400, 'cPDes' => $code->code, 'cantidad' => 1, 'valor' => $this->total / 100];
        $price = DeliveryServiceController::obtenerTarifas($params);
        $this->sendPrice = $price;

        $this->dispatch('sendPriceUpdated', $this->sendPrice);
    }

    public function updatedSucursal()
    {
        $this->updatedSendPrice(false);
    }

    public function updatedCity($cityId)
    {
        $this->city = $cityId;
        $this->updatedSendPrice(true);
    }

    public function mount(User $user)
    {
        if (Auth::check()) {
            $this->cartManager = new CartManager();
        } else {
            $this->cartManager = new SessionCartManager();
        }
        $this->cartItems = $this->cartManager->getCartContents();
        $this->total = $this->cartManager->getCartTotal();

        $this->fill($user);
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
        $this->productItems = ProductItem::all();
        if ($this->cartItems->isNotEmpty()) {
            $itemCount = 0;
            foreach ($this->cartItems as $item) {
                if ($item->type == CartItem::DEFAULT_TYPE) {
                    $itemModel = ProductItem::find($item->item_id);
                    $itemQuantity = $item->quantity;
                    $discount = $itemModel->product->sale->sale->discount ?? 0;
                    $price = $itemModel->price();
                    $priceDiscount = ($price * $discount) / 100;
                    $this->volume += $itemModel->product->volume;
                    $this->weight += $itemModel->product->weight;
                    $itemCount += $itemQuantity;
                } else if ($item->type == CartCombo::DEFAULT_TYPE) {
                    foreach ($item->contents as $cartItem) {
                        $itemModel = ProductItem::find($cartItem->item_id);
                        $itemQuantity = $item->quantity;
                        $discount = $itemModel->product->sale->sale->discount ?? 0;
                        $price = $itemModel->price();
                        $priceDiscount = ($price * $discount) / 100;
                        $this->volume += $itemModel->product->volume;
                        $this->weight += $itemModel->product->weight;
                        $itemCount += $itemQuantity;
                    }
                }
            }
            $this->itemCount = $itemCount;
        }
    }

    public function render()
    {
        return view('livewire.checkout-config');
    }
}
