<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserProfileRequest;
use App\Events\UpdateNotification;
use App\Models\User;
use Auth;

class UserController extends Controller
{

    /**
     * Apply middleware exists show, edit and update actions
     */
    public function __construct() {
        $this->middleware('exists:' . User::class, [
            'only' => [
                'show', 'edit', 'update',
            ]
        ]);
    }

    /**
     * Show user profile by their id
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('auth.user.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show user edit form
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('auth.user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * It retrieves the user, checks the filled in fields and makes a more detailed check on the image request, where the previous avatar is deleted from the system if it has already changed its photo once. Then an event is dispatched
     * 
     * @param \Illuminate\Http\UserProfileRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserProfileRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if (isset($request->name)) {
            $user->name = $request->name;
        }

        if (isset($request->email)) {
            $user->email = $request->email;
        }

        if (isset($request->biography)) {
            $user->biography = $request->biography;
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            
            if ($user->avatar !== "default-user-avatar.png") {
                Storage::disk('public')->delete("images/user/avatar/$user->avatar");
            }

            $newName = $request->file('avatar')->hashName();

            $request->file('avatar')->storeAs('public/images/user/avatar', $newName);
            
            $user->avatar = $newName;
        
        }

        $user->save();

        UpdateNotification::dispatch($user);

        return redirect("/user/$user->id")->with('success_msg', 'Perfil atualizado com sucesso!');
    }

}
