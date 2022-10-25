<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentRegimenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'note' => $this->faker->paragraph

        ];
    }
}