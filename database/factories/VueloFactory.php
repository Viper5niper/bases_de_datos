<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VueloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'origen_id' => $this->faker->unique(true)->numberBetween(1, 34),
            'destino_id' => $this->faker->unique(true)->numberBetween(1, 34),
            'avion_id' => $this->faker->unique(true)->numberBetween(1, 34),
            'despegue' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'aterrizaje' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'precio' => $this->faker->unique(true)->numberBetween(200, 1500),
            'recorrido' => $this->faker->unique(true)->numberBetween(200, 700),
        ];
    }
}
