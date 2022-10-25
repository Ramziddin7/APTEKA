<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DebtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            'deadline' => $this->faker->date,
            'notification_number' => $this->faker->numberBetween(0, 3),
            'status' => $this->faker->randomElement(['paid', 'unpaid']),
            'user_id' => User::all()->random()->id,
            'paid_amount' => $this->faker->numberBetween(0, 100000)
        ];
    }
}