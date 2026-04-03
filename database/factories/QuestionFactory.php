<?php

namespace Database\Factories;

use App\Models\Node;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'node_id' => Node::factory(),
            'type' => fake()->randomElement(['essay', 'multiple_choice', 'true_false']),
            'content' => fake()->paragraph(),
        ];
    }
}
