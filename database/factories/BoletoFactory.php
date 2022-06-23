<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BoletoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vuelo_id' => $this->faker->unique(true)->numberBetween(1, 100),
            'pasajero_id' => $this->faker->unique(true)->numberBetween(1, 100),
            "llegada" => $this->faker->boolean(50) ?  $this->faker->date($format = 'Y-m-d', $max = 'now') : null
        ];
    }
}
