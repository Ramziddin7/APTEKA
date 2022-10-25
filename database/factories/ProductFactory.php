<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            'global_name' => $this->faker->companySuffix,
            'manufacturer_id' => Manufacturer::all()->random()->id,
            'unit_id' => Unit::all()->random()->id,
            'mandatory_assortment' => $this->faker->paragraph,
            'barcode' => $this->faker->randomNumber(),
        ];
    }
}
