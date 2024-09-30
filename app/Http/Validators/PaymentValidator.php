<?php
namespace App\Http\Validators;

use App\Rules\ZipCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class PaymentValidator extends FacadesValidator
{
    /**
     * Validate an address' fields from a request.
     * 
     *
     * @param \Illuminate\Http\Request $request The request object to validate
     * @return void
     */
    public function validateRequest(Request $request)
    {
        $request->validate([
            'transaction_amount' => 'required|numeric',
            'token' => 'required|string',
            'installments' => 'required|integer',
            'payment_method_id' => 'required|string',
            'issuer_id' => 'required|integer',
            'payer.email' => 'required|email',
            'payer.identification.type' => 'required|string',
            'payer.identification.number' => 'required|string',
        ]);
    }
}

?>