<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'invoice_number' => $this->faker->randomDigit,
            'invoice_date' => $this->faker->date,
            'organization_id' => Organization::all()->random()->id,
            'accept_by' => User::all()->random()->id,
            'payment_type' => $this->faker->randomElement(['cash', 'transfer']),
            'total_price' => $this->faker->numberBetween(1000, 100000)
        ];
    }
}