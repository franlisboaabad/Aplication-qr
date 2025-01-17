<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_empresa' => $empresa = $this->faker->company,
            'carta_path' => $this->faker->url,
            'slug' => Str::slug($empresa)
        ];
    }
}
