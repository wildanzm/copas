<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ClassRoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word() . ' Class',
            'teacher_id' => User::factory(),
        ];
    }
}
