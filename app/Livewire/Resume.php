<?php

namespace App\Livewire;

use Livewire\Component;

use App\Http\Cart\CartCombo;
use App\Http\Cart\CartItem;
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
use App\Models\TransferInfo;

class Resume extends Component
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
    public $volume;
    public $weight;
    public $productItems;
    public $cartItems;

    public $itemCount;

    public $city;
    #[Validate]
    public $address;

    // ShippingCost.php
    public $alias;
    public $cbu;
    public $holder_name;

    public $sendPrice;

    protected $listeners = ['sendPriceUpdated' => 'updateSendPrice'];

    public function updateSendPrice($newPrice)
    {
        $this->sendPrice = $newPrice;
    }


    public function mount(User $user)
    {
        // Configuración del administrador de carrito
        $this->cartManager = Auth::check() ? new CartManager() : new SessionCartManager();

        $this->cartItems = $this->cartManager->getCartContents();
        $this->total = $this->cartManager->getCartTotal();

        $this->fill($user);

        // Carga de dirección de usuario
        if ($user->address != null) {
            $this->zip_code = $user->address->zipCode->code;
            $this->cities = City::where('province_id', $user->address->province->id)->get()->sortBy('name');
            $this->province = $user->address->province->name;
            $this->city = $user->address->city_id;
            $this->fill($user->address->only('name', 'last_name', 'address', 'street', 'number', 'department', 'street1', 'street2', 'observation'));
        }

        $this->productItems = ProductItem::all();
        $this->calculateCartItems();
    }

    protected function calculateCartItems()
    {
        if ($this->cartItems->isNotEmpty()) {
            $itemCount = 0;
            foreach ($this->cartItems as $item) {
                if ($item->type == CartItem::DEFAULT_TYPE) {
                    $itemModel = ProductItem::find($item->item_id);
                    $itemQuantity = $item->quantity;
                    $this->volume += $itemModel->product->volume;
                    $this->weight += $itemModel->product->weight;
                    $itemCount += $itemQuantity;
                } elseif ($item->type == CartCombo::DEFAULT_TYPE) {
                    foreach ($item->contents as $cartItem) {
                        $itemModel = ProductItem::find($cartItem->item_id);
                        $itemQuantity = $item->quantity;
                        $this->volume += $itemModel->product->volume;
                        $this->weight += $itemModel->product->weight;
                        $itemCount += $itemQuantity;
                    }
                }
            }
            $this->itemCount = $itemCount;
        }
    }

    /* protected function calculateSendPrice()
    {
        $code = Province::where('name', $this->province)->first();
        $code = ModelsZipCode::where('province_id', $code->id)->first();
        $params = [
            'operativa' => 64665,
            'peso' => $this->weight,
            'volumen' => $this->volume,
            'cP' => 3400,
            'cPDes' => $code->code,
            'cantidad' => 1,
            'valor' => $this->total / 100
        ];
        $price = DeliveryServiceController::obtenerTarifas($params);
        $this->sendPrice = $price;
    } */

    public function render()
    {
        return view('livewire.resume', ['sendPrice' => $this->sendPrice]);
    }
}
