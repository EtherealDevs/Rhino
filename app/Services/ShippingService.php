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
    /**
     * Get the shipping costs for a delivery to specified address.
     *
     * @param Address|string|int $address Either an address model or a zip code to be used to find the address model.
     * @param int|string $cpDest The destination zip code of the delivery.
     *
     * @return float $price The calculated shipping price.
     *
     * @throws Exception If any required data is missing, failed validation, or if the associated models cannot be found.
     */
    public function getShippingCosts(Address|string|int $address)
    {
        if ($address instanceof Address) {
            try {
                $zipCode = $this->addressValidator->validateZipCode($address->zipCode->code);
                $cpDest = (int) $zipCode;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        else if (is_string($address) || is_int($address))
        {
            try {
                $zipCode = $this->addressValidator->validateZipCode($address);
                $address = $this->addressService->getAddressFromZipCode($zipCode);
                $cpDest = (int) $zipCode;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        $props = $this->cartService->getCartItemsProperties();
        $weight = $props['weight'] ?? 0;
        $volume = $props['volume'] ?? 0;
        $total = $props['total'] ?? 0;
        $params = ['operativa' => 94584, 'peso' => $weight, 'volumen' => $volume, 'cP' => (int) config('app.delivery_service.origin_zipcode'), 'cPDes' => $cpDest, 'cantidad' => 1, 'valor' => (int) ($total / 100)];
        $price = DeliveryServiceController::obtenerTarifas($params);
        return (float) $price;
    }
    public function getSucursales($zipCode) 
    {
        $zipCode = $this->addressValidator->validateZipCode($zipCode);
        $zipCode = (int) $zipCode;
        return DeliveryServiceController::obtenerSucursales($zipCode);
    }
}