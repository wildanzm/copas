<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentAnswerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'question_id' => Question::factory(),
            'answer_text' => fake()->word(),
            'score' => fake()->optional()->numberBetween(0, 100),
            'graded_at' => fake()->optional()->dateTime(),
        ];
    }
}
