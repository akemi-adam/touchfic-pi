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
         * Insere dados padrões na aplicação
         */

        $this->startDatas(Permission::class, ['commun user', 'moderator', 'admin'], 'permission');

        $this->startDatas(Agegroup::class, ['Livre', '10', '12', '14', '16', '+18'], 'agegroup');

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

    /**
     * Função para inserir dados básicos necessários caso não exista nada nas tabelas necessárias
     * 
     * @param App\Models\<Model> $model
     * @param array $datas
     * @param string $column
     * 
     * @return void
     */

    private function startDatas($model, $datas, $collumn)
    {
        if (count($model::all()) < 0 || count($model::all()) === 0) {
            foreach ($datas as $data) {
                $model::create([
                    $collumn => $data,
                ]);
            }
        }
    }

}
