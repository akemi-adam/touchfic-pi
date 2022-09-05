<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Auth;

class SocialAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $existingUser = User::where('google_id', $user->id)->first();

        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {
/*             $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
            ]); */

            $newUser = new User;

            $newUser->name = $user->name;

            $newUser->email = $user->email;

            $newUser->google_id = $user->id;

            $newUser->permission_id = 1;

            $newUser->password = Hash::make(Str::random(10));

            Auth::login($newUser, true);
        }

        return redirect()->to('/dashboard');
    }
}
