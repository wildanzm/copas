<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NodeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'type' => fake()->randomElement(['material', 'quiz']),
            'order_index' => fake()->numberBetween(1, 100),
            'video_url' => fake()->url(),
        ];
    }
}
