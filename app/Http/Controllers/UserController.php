<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('auth.user.show', [
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('auth.user.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (isset($request->name)) {
            $user->name = $request->name;
        }

        if (isset($request->email)) {
            $user->email = $request->email;
        }

        $user->save();

        return redirect("/user/$user->id")->with('success_msg', 'Perfil atualizado com sucesso!');
    }
    
}
