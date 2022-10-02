<?php

namespace App\Classes\Data;

use App\Models\User;
use Auth;

class UserData
{
    public function authUser($admin = false)
    {
        if ($admin) {

            $user = User::factory()->create([
                'permission_id' => 3
            ]);

            Auth::login($user);

            return $user;
        }

        $user = User::factory()->create();

        Auth::login($user);

        return $user;
        
    }
}