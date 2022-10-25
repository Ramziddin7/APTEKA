<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'branch_id' => Branch::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'status' => $this->faker->randomElement(['new', 'debt', 'accepted']),
            'total_price' => $this->faker->numberBetween(10, 10000),
        ];
    }
}