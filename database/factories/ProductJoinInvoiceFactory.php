<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductJoinInvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::all()->random()->id,
            'invoice_id' => Invoice::all()->random()->id,
            'series' => $this->faker->text,
            'deadline' => $this->faker->date,
            'amount' => $this->faker->numberBetween(),
            'base_price' => $this->faker->numberBetween(0, 15),
            'base_price_percent' => $this->faker->numberBetween(44, 88),
            'trade_discount' => $this->faker->numberBetween(33, 44),
            'delivery_cost' => $this->faker->numberBetween(25, 55),
            'vat' => $this->faker->numberBetween(15, 50),
            'certificate' => $this->faker->numberBetween(10, 25),
            'price' => $this->faker->numberBetween(50000, 500000),

        ];
    }
}