<?php

namespace App\Services;

use App\Http\Cart\CartCombo;
use App\Http\Cart\CartItem;
use App\Http\Cart\CartManager;
use App\Http\Cart\SessionCartManager;
use App\Http\Controllers\DeliveryServiceController;
use App\Http\Validators\AddressValidator;
use App\Models\Address;
use App\Models\Combo;
use App\Models\ProductItem;
use App\Models\Province;
use App\Models\ZipCode;
use Illuminate\Support\Facades\Auth;

class ShippingService
{
    private $addressService;
    private $addressValidator;
    private $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();
        $this->addressService = new AddressService();
        $this->addressValidator = new AddressValidator();
    }
    public function getShippingCosts(Address|string|int $addressOrZipCode, int $operativa)
    {

        if ($addressOrZipCode instanceof Address) {
            try {
                $zipCode = $this->addressValidator->validateZipCode($addressOrZipCode->zipCode->code);
                $cpDest = (int) $zipCode;
            } catch (\Throwable $th) {
                throw $th;
            }
        } else if (is_string($addressOrZipCode) || is_int($addressOrZipCode)) {
            try {
                $zipCode = $this->addressValidator->validateZipCode($addressOrZipCode);
                $addressOrZipCode = $this->addressService->getAddressFromZipCode($zipCode);
                $cpDest = (int) $zipCode;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        $props = $this->cartService->getCartItemsProperties();
        $weight = $props['weight'] ?? 0;
        $volume = $props['volume'] ?? 0;
        $total = $props['total'] ?? 0;

        $params = ['operativa' => $operativa, 'peso' => $weight / 1000, 'volumen' => $volume / 1000000, 'cP' => (int) config('app.delivery_service.origin_zipcode'), 'cPDes' => $cpDest, 'cantidad' => 1, 'valor' => (int) ($total / 100)];
        $price = DeliveryServiceController::obtenerTarifas($params);
        return (float) $price;
    }
    public function getSucursales($zipCode)
    {
        $zipCode = $this->addressValidator->validateZipCode($zipCode);
        $zipCode = (int) $zipCode;
        return DeliveryServiceController::obtenerSucursales($zipCode);
    }
    public function getSucursalesIds($zipCode)
    {
        $sucursales = $this->getSucursales($zipCode);
        $sucursalesIds = [];
        foreach ($sucursales as $sucursal) {
            array_push($sucursalesIds, $sucursal['IdCentroImposicion']);
        }
        return $sucursalesIds;
    }
}
