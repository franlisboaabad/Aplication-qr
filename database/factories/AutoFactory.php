<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'marca' => $this->faker->word,
            'modelo' => $this->faker->word,
            'anio' => $this->faker->numberBetween(1999, 2023),
        ];
    }
}
