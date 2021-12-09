<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'url' => $this->faker->url(),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
