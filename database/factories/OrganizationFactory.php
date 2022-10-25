<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'full_name' => $this->faker->companySuffix,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'district_id' => District::all()->random()->id,
        ];
    }
}