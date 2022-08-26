<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\UserProfileRequest;
use App\Models\User;
use Auth, File;

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

    public function update(UserProfileRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if (isset($request->name)) {
            $user->name = $request->name;
        }

        if (isset($request->email)) {
            $user->email = $request->email;
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {

            if (!($user->avatar === "default-user-avatar.png")) {
                File::delete('img/user/avatar/' . $user->avatar);
            }

            $requestAvatar = $request->avatar;
            $extension = $requestAvatar->extension();
            $avatarName = md5($requestAvatar->getClientOriginalName() . strtotime('now') . '.' . $extension);

            $request->avatar->move(public_path('img/user/avatar'), $avatarName);
            $user->avatar = $avatarName;

        }

        $user->save();

        return redirect("/user/$user->id")->with('success_msg', 'Perfil atualizado com sucesso!');
    }

}
