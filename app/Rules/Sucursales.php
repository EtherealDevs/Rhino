<?php

namespace App\Rules;

use App\Services\ShippingService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Sucursales implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $shippingService = new ShippingService();
        $sucursales = 
        $sucursalId = $value;
        // if (!is_array($sucursales)) {
        //     $fail('Debe seleccionar al menos una sucursal.');
        // }
        // $provinceModels = ProvinceModel::all();
        // if (is_string($province)) {
        //     foreach ($provinceModels as $provinceModel) {
        //         $name = strtolower($provinceModel->name);
        //         if (strtolower($province) === $name) {
        //             $province = $provinceModel;
        //             break;
        //         }
        //     }
        // } else if (is_int($province))
        // {
        //     $provinceModel = $provinceModels->find($province);
        //     if ($provinceModel != null) {
        //         $province = $provinceModel;
        //     }
        // }
        // if ($province == null) {
        //     $fail('No se encontro la provincia que ingresaste.');
        // }
    }
}