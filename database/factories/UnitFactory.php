<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['kilogram', 'gram', 'dona', 'to`plam']),
            'short_name' => $this->faker->randomElement(['kg', 'gr', 'sht', 'upk']),
        ];
    }
}