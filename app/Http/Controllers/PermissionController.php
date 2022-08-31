<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
    public function index()
    {
        $admins = User::where('permission_id', 3)->get();
        $moderators = User::where('permission_id', 2)->get();
        return view('admin.permission.index', [
            'admins' => $admins,
            'moderators' => $moderators,
        ]);
    }

    public function edit()
    {
        $users = User::where('permission_id', '!=', '3')->where('permission_id', '!=', '2')->get();
        return view('admin.permission.edit', [
            'users' => $users,
        ]);
    }

    public function update(Request $request)
    {
        $permission = $request->promotion == 3 ?: 2;
        $user = User::findOrFail($request->promoted_user);
        $user->permission_id = $permission;
        $user->save();

        return redirect('/admin/permission/index')->with('success_msg', "$user->name foi promovido a um novo cargo!");
    }

    public function change(User $user)
    {
        $permissions = Permission::where('permissions.id', '!=', $user->permission_id)->get();

        return view('admin.permission.change', [
            'user' => $user,
            'permissions' => $permissions,
        ]);
    }

    public function transference(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->permission_id = $request->new_position;
        $user->save();

        return redirect('/admin/permission/index')->with('success_msg', "$user->name mudou de posição!");
    }
}
