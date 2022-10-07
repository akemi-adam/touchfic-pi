<?php

namespace App\Classes\Data;

use App\Models\User;
use App\Enums\UserRole;
use Auth;

class UserData
{
    /**
     * Returns an authenticated user who may or may not be an administrator
     * 
     * @param boolean $admin
     * 
     * @return User
     */
    public function authUser($admin = false) : User
    {
        return $admin ? $this->create(['permission_id' => UserRole::ADMIN]) : $this->create();
    }

    /**
     * Returns an authenticated user
     * 
     * @param array $options
     * 
     * @return User
     */
    protected function create(array $options = []) : User
    {
        $user = User::factory()->create($options);

        Auth::login($user);

        return $user;
    }
}