<?php
namespace App\Services;

use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use App\Models\ZipCode;

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
            'phone_number' => $data['last_name'],
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
}

?>