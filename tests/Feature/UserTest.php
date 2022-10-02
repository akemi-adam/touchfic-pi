<?php

use App\Models\User;

it('has the user profile page', function () {

    $user = User::factory()->create();

    Auth::login($user);

    $response = $this->get('/user/' . $user->id);

    $response->assertStatus(200);

});

it('has the profile edit form page', function () {
    
    $user = User::factory()->create();

    Auth::login($user);

    $response = $this->get('/user/' . $user->id . '/edit');

    $response->assertStatus(200);

});

it('can update a profile', function () {

    $user = User::factory()->create();

    Auth::login($user);

    $user->name = 'New Name';

    $this->actingAs($user)->put('/user/' . $user->id, [
        'name' => 'New Name',
        'email' => 'email@example.com',
    ]);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'New Name',
        'email' => 'email@example.com',
    ]);

});