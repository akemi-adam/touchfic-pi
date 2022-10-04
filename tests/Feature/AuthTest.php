<?php

use App\Models\User;

uses()->group('auth');

it('has dashboard page', function () {

    $user = UserData::authUser();

    $this->get('/dashboard')->assertStatus(200);

});

it('cannot access dashboard page')->get('/dashboard')->assertStatus(302);

it('has login page')->get('/login')->assertStatus(200);

it('cannot access login page', function () {
   
    UserData::authUser();

    $this->get('/login')->assertStatus(302);

});

it('has register page')->get('/register')->assertStatus(200);

it('cannot access register page', function () {
    
    UserData::authUser();

    $this->get('/register')->assertStatus(302);

});

it('has google login page')->get('/login-google')->assertStatus(302);

it('cannot access google login page', function () {

    UserData::authUser();

    $this->get('/login-google')->assertStatus(302);

});
