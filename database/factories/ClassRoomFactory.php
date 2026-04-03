<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassRoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word().' Class',
            'teacher_id' => User::factory(),
        ];
    }
}
