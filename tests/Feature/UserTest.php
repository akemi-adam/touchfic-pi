<?php

use App\Models\User;

uses()->group('user');

it('has the user profile page', function () {

    $user = UserData::authUser();

    $response = $this->get(route('user.show', $user->id));

    $response->assertStatus(200);

});

it('has the profile edit form page', function () {
    
    $user = UserData::authUser();

    $response = $this->get(route('user.edit', $user->id));

    $response->assertStatus(200);

});

it('can update a profile', function () {

    $user = User::factory()->create();

    $newName = fake()->name();
    $newEmail = fake()->safeEmail();

    $this->actingAs($user)->put(route('user.update', $user->id), [
        'name' => $newName,
        'email' => $newEmail,
    ])->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => $newName,
        'email' => $newEmail,
    ]);

});