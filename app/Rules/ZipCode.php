<?php

namespace App\Rules;

use App\Models\ZipCode as ModelsZipCode;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ZipCode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $zipCode = ModelsZipCode::where('code', '=', $value)->first();
        if ($zipCode == null) {
            $fail('No se encontro el codigo postal que ingresaste. Revisá que este bien escrito. Recordá que es un código numérico de solo 4 espacios, por ejemplo: 3400. Si no sabes tu codigo postal podes usar el siguiente recurso: https://www.correoargentino.com.ar/formularios/cpa');
        }
    }
}
