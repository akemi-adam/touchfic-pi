<?php

use App\Models\User;

it('has dashboard page', function () {

    $user = User::factory()->create();

    Auth::login($user);

    $response = $this->get('/dashboard');

    $response->assertStatus(200);
});
