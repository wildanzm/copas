<?php

use App\Models\User;
use Laravel\Fortify\Features;

beforeEach(function () {
    $this->skipUnlessFortifyFeature(Features::registration());
});

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'username' => 'johndoe',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'school' => 'SMA Negeri 1',
        'terms' => '1',
    ]);

    $response->assertSessionHasNoErrors()
        ->assertRedirect();

    $this->assertAuthenticated();
});

test('registration fails with missing required fields', function () {
    $response = $this->post(route('register.store'), []);

    $response->assertSessionHasErrors(['name', 'email', 'password']);
});

test('registration fails with invalid email', function () {
    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'username' => 'johndoe',
        'email' => 'not-an-email',
        'password' => 'password',
        'password_confirmation' => 'password',
        'school' => 'SMA Negeri 1',
        'terms' => '1',
    ]);

    $response->assertSessionHasErrors(['email']);
});

test('registration fails when passwords do not match', function () {
    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'username' => 'johndoe',
        'email' => 'test2@example.com',
        'password' => 'password',
        'password_confirmation' => 'different',
        'school' => 'SMA Negeri 1',
        'terms' => '1',
    ]);

    $response->assertSessionHasErrors(['password']);
});

test('registration fails when email is already taken', function () {
    User::factory()->create(['email' => 'duplicate@example.com']);

    $response = $this->post(route('register.store'), [
        'name' => 'Jane Doe',
        'username' => 'janedoe',
        'email' => 'duplicate@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'school' => 'SMA Negeri 1',
        'terms' => '1',
    ]);

    $response->assertSessionHasErrors(['email']);
});
