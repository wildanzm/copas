<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, array_merge($this->profileRules(), [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'school' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => ['required', 'accepted'], // Adding validation for the terms checkbox
        ]))->validate();

        $user = User::create([
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'school' => $input['school'],
            'password' => $input['password'],
        ]);

        // Assign teacher role to the newly created user
        $user->assignRole('teacher');

        return $user;
    }
}
