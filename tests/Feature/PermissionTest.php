<?php

use App\Enums\UserRole;
use App\Models\User;

uses()->group('permission');

it('has administrators and moderators page', function () {

    UserData::authUser(true);

    $this->get(route('admin.permission.index'))->assertStatus(200);

});

it('has an edit job form', function () {

    UserData::authUser(true);

    $this->get(route('admin.permission.edit', ))->assertStatus(200);

});

it('can update a job', function () {

    UserData::authUser(true);

    $user = User::factory()->create();

    $request = [
        'id' => $user->id,
        'permission_id' => random_int(UserRole::MODERATOR, UserRole::ADMIN)
    ];

    $this->put(route('admin.permission.update', $request))->assertStatus(302);

    $this->assertDatabaseHas('users', $request);

});

it('has the job change form', function () {

    UserData::authUser(true);

    $user = User::factory()->create();

    $this->get(route('admin.permission.change', $user))->assertStatus(200);

});

it('can transference the job of a user', function () {

    UserData::authUser(true);

    $user = User::factory()->create();

    $permission_id = random_int(UserRole::MODERATOR, UserRole::ADMIN);

    $this->put(route('admin.permission.transference', $user->id), [
        'permission_id' => $permission_id
    ])->assertStatus(302);

    $this->assertModelExists($user);
    
});