<?php

use App\Models\User;
use App\Enums\UserRole;

/**
 * Dashboard Tests
 */

it('has admin dashboard', function () {

    UserData::authUser(true);

    $response = $this->get(route('admin.dashboard'));

    $response->assertStatus(200);

});

it('cannot access admin dashboard', function () {

    UserData::authUser();

    $response = $this->get(route('admin.dashboard'));

    $response->assertStatus(403);

});

/**
 * Position and change tests
 */

it('has admins and moderators listed', function () {

    UserData::authUser(true);

    $response = $this->get(route('admin.permission.index'));

    $response->assertStatus(200);

});

it('cannot access the list of admins and moderators', function () {
    
    UserData::authUser();

    $response = $this->get(route('admin.permission.index'));

    $response->assertStatus(403);

});

it('has the user role edit form', function () {
    
    UserData::authUser(true);

    $response = $this->get(route('admin.permission.edit'));

    $response->assertStatus(200);

});

it('cannot access function edit form', function () {
    
    UserData::authUser();

    $response = $this->get(route('admin.permission.edit'));

    $response->assertStatus(403);

});

it("can update a user's role", function () {
    
    UserData::authUser(true);

    $user = User::factory()->create();

    $data = [
        'id' => $user->id,
        'permission_id' => random_int(UserRole::MODERATOR, UserRole::ADMIN),
    ];

    $response = $this->put(route('admin.permission.update'), $data);

    $response->assertStatus(302);

    $this->assertDatabaseHas('users', $data);

});

it('shows the role change form', function () {

    UserData::authUser(true);

    $user = User::factory()->create();

    $response = $this->get(route('admin.permission.change', $user));

    $response->assertStatus(200);

});

it('not shows the role change form', function () {

    UserData::authUser();

    $user = User::factory()->create();

    $response = $this->get(route('admin.permission.change', $user));

    $response->assertStatus(403);

});

it('can change user role', function () {
    
    UserData::authUser(true);

    $permission_id = random_int(UserRole::COMMON_USER, UserRole::ADMIN);

    $user = User::factory()->create([
        'permission_id' => $permission_id,
    ]);

    $response = $this->put(route('admin.permission.transference', [
        'id' => $user->id,
        'permission_id' => $permission_id,
    ]));

    $response->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'permission_id' => $permission_id,
    ]);

});