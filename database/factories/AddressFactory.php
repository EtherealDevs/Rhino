<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provincias = File::json('public/storage/json/argentina_states.json');
        return [
            'name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'address' => $this->faker->streetAddress(),
            'street' => $this->faker->streetName(),
            'number' => $this->faker->buildingNumber(),
            'department' => $this->faker->secondaryAddress(),
            'street1' => $this->faker->streetName(),
            'street2' => $this->faker->streetName(),
            'observation' => $this->faker->sentence()

        ];
    }
}
