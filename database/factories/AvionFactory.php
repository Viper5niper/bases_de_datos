<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AvionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'modelo' => $this->faker->company(),
            'fabricante' => $this->faker->company(),
            'capacidad' => 700,
            'aerolinea_id' => $this->faker->unique(true)->numberBetween(1, 100),
        ];
    }
}
