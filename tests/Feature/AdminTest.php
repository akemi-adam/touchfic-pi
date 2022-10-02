<?php

use App\Models\User;

it('has admin dashboard', function () {

    $user = UserData::authUser(true);

    $response = $this->get(route('admin.dashboard'));

    $response->assertStatus(200);

});

it('has admins and moderators listed', function () {

    $user = UserData::authUser(true);

    $response = $this->get(route('admin.permission.index'));

    $response->assertStatus(200);

});