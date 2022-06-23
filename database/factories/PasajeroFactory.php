<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PasajeroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->name(),
            'genero' => $this->faker->randomElement(['M', 'F']),
            'fecha_nacimiento' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'ubicacion_id' => $this->faker->unique(true)->numberBetween(1, 34),
        ];
    }
}
