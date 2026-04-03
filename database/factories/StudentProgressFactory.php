<?php

namespace Database\Factories;

use App\Models\Node;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentProgressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'node_id' => Node::factory(),
            'status' => fake()->randomElement(['locked', 'unlocked', 'completed']),
            'unlocked_at' => fake()->optional()->dateTime(),
        ];
    }
}
