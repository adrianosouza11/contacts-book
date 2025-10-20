<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactBook>
 */
class ContactBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contact_name'     => $this->faker->name(),
            'contact_phone'    => $this->faker->phoneNumber(),
            'contact_email'    => $this->faker->unique()->safeEmail(),
            'address'          => $this->faker->streetAddress(),
            'number'           => $this->faker->buildingNumber(),
            'neighborhood'     => $this->faker->word(),
            'city'             => $this->faker->city(),
            'state'            => $this->faker->stateAbbr(),
            'postal_code'      => $this->faker->postcode(),
        ];
    }
}
