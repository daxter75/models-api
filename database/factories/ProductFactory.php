<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'brand_id' => $this->faker->numberBetween(1, 100),
            'name' => $this->faker->sentence(4),
            'product_no' => $this->faker->word(),
            'scale' => '1:' . $this->faker->numberBetween(1, 3000),
            'age' => $this->faker->numberBetween(1, 101),
            'level' => $this->faker->numberBetween(1,5),
            'no_parts' => $this->faker->numberBetween(1, 5000),
            'length' => $this->faker->numberBetween(10, 1000),
            'width' => $this->faker->numberBetween(10, 1000),
            'height' => $this->faker->numberBetween(10, 500),
            'wingspan' => $this->faker->numberBetween(10, 500),
            'url' => $this->faker->url(),
            'purchased_at' => $this->faker->date('Y-m-d', 'now'),
            'finished_at' => $this->faker->date('Y-m-d', 'now'),
            'author_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}
