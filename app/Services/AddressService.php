<?php
namespace App\Services;

use App\Http\Validators\AddressValidator;
use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\ZipCode;
use Exception;

class AddressService
{
    /**
     * This function is responsible for saving or updating an address record in the database.
     *
     * @param array $data An associative array containing the address data.
     * @param User $user The user object associated with the address.
     *
     * @return Address The saved or updated address record.
     *
     * @throws Exception If any required data is missing or if the associated models cannot be found.
     */
    public function saveOrUpdate(array $data, User $user)
    {
        // Validate and prepare the address fields
        $fields = [
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'zip_code_id' => ZipCode::where('code', '=', $data['zip_code'])->first()->id,
            'province_id' => Province::where('name', $data['province'])->first()->id,
            'city_id' => City::where('id', $data['city'])->first()->id,
            'address' => $data['address'],
            'street' => $data['street'],
            'number' => $data['number'],
            'department' => $data['department'],
            'street1' => $data['street1'],
            'street2' => $data['street2'],
            'observation' => $data['observation'] ?? null,
        ];
    
        // Save or update the address record
        $address = Address::updateOrCreate(
            ['user_id' => $user->id],
            $fields
        );
    
        return $address;
    }
    public function getAddressFromZipCode($zipCode)
    {
        $addressValidator = new AddressValidator();
        $zipCode = $addressValidator->validateZipCode($zipCode);

        // Validate the existence of the zip code in the database
        $zipCodeModel = ZipCode::where('code', $zipCode)->first();
        if (!$zipCodeModel) {
            throw new Exception('Zip code not found');
        }

        // Validate the existence of the province and city associated with the zip code
        $provinceModel = Province::where('id', $zipCodeModel->province->id)->first();
        if (!$provinceModel) {
            throw new Exception('Invalid zip code or associated province not found');
        }
        
        // Fetch the address record from the database based on the zip code
        $address = Address::where('zip_code_id', $zipCodeModel->id)->first();
        return $address;
    }
}

?>