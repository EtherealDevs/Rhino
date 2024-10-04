<?php
namespace App\Http\Validators;

use App\Rules\ZipCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AddressValidator extends FacadesValidator
{
    /**
     * Validate an address' fields from a request.
     * 
     *
     * @param \Illuminate\Http\Request $request The request object to validate
     * @return array An array of validated fields
     */
    public function validateRequest(Request $request)
    {
        $validatedFields = $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode],
            'province' => 'required',
            'city' => 'required',
            'address' => 'required|string',
            'street' => 'required|string',
            'number' => 'string|nullable',
            'department' => 'string|nullable',
            'street1' => 'string|nullable',
            'street2' => 'string|nullable',
            'observation' => 'string|nullable',
        ]);
        return $validatedFields;
    }
    public function validateZipCode(string|int $zipCode)
    {
        $validator = FacadesValidator::make(['zip_code' => $zipCode], [
            'zip_code' => ['required', 'numeric', 'digits:4', new ZipCode]
        ]);
        if ($validator->passes()) {
            return $zipCode;
        } else {
            return $validator->errors()->first('zip_code');
        }
    }
}

?>