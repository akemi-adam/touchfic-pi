<?php

use App\Models\User;

it('has admin dashboard', function () {

    UserData::authUser(true);

    $response = $this->get(route('admin.dashboard'));

    $response->assertStatus(200);

});

it('has admins and moderators listed', function () {

    UserData::authUser(true);

    $response = $this->get(route('admin.permission.index'));

    $response->assertStatus(200);

});

it('has the user role edit form', function () {
    
    UserData::authUser(true);

    $response = $this->get(route('admin.permission.edit'));

    $response->assertStatus(200);

});

it("can update a user's role", function () {
    
    UserData::authUser(true);

    $user = User::factory()->create();

    $data = [
        'id' => $user->id,
        'permission_id' => random_int(2, 3),
    ];

    $response = $this->put(route('admin.permission.update'), $data);

    $response->assertStatus(302);

    $this->assertDatabaseHas('users', $data);

});