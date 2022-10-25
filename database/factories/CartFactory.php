<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
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
            'product_id' => Product::all()->random()->id,
            'quantity' => $this->faker->numberBetween(10, 10000),
        ];
    }
}