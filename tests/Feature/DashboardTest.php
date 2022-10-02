<?php

use App\Models\User;

it('has dashboard page', function () {

    $user = UserData::authUser();

    $response = $this->get('/dashboard');

    $response->assertStatus(200);
});
