<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Node;

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
