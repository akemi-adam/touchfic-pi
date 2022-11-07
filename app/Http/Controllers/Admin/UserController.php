<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserProfileRequest;
use App\Events\UpdateNotification;
use App\Models\User;
use Auth, FileSupport, RequestSupport, Logger;

class UserController extends Controller
{

    /**
     * Apply middleware exists show, edit and update actions
     * 
     * @return void
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
     * 
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        Logger::log('user', 'info', $user->name . "'s profile was acessed");

        return view('auth.user.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show user edit form
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        Logger::log('user', 'info', $user->name . ' has acessed the profile editing form');

        return view('auth.user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * It retrieves the user, checks the filled in fields and makes a more detailed check on the image request, where the previous avatar is deleted from the system if it has already changed its photo once. Then an event is dispatched
     * 
     * @param UserProfileRequest $request
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserProfileRequest $request, $id)
    {
        $user = User::findOrFail($id);

        RequestSupport::setEditValues($request, $user, ['name', 'email', 'biography']);

        FileSupport::avatar($request, $user);

        $user->save();

        UpdateNotification::dispatch($user);

        Logger::log('user', 'info', $user->name . ' updated her profile');

        return redirect("/user/$user->id")->with('success_msg', 'Perfil atualizado com sucesso!');
    }

}
