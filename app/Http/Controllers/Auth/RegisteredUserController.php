<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Agegroup;
use App\Models\Permission;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        /**
         * Define os níveis de permissões (cargos) básicos no sistema
         */

        if (count(Permission::all()) < 0 || count(Permission::all()) === 0) {

            $permissions = ['commun user', 'moderator', 'admin'];

            foreach ($permissions as $permission) {
                Permission::create([
                    'permission' => $permission,
                ]);
            }

        }

        /**
         * Define as faixas etárias básicas do sistema
         */

        if (count(Agegroup::all()) < 0 || count(Agegroup::all()) === 0) {

            $agegroups = ['Livre', '10', '12', '14', '16', '+18'];

            foreach ($agegroups as $agegroup) {
                Agegroup::create([
                    'agegroup' => $agegroup,
                ]);
            }

        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permission_id' => 1,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
