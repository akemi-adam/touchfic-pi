<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
    
    /**
     * Shows all admins and moderators
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('admin_operations');

        $admins = User::where('permission_id', 3)->get();

        $moderators = User::where('permission_id', 2)->get();

        return view('admin.permission.index', [
            'admins' => $admins,
            'moderators' => $moderators,
        ]);
    }

    /**
     * Make a query in the bank behind regular users
     * 
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $this->authorize('admin_operations');

        $users = User::where('permission_id', '1')->get();

        return view('admin.permission.edit', [
            'users' => $users,
        ]);
    }

    /**
     * Retrieves the user to be promoted, checks the job level assigned to him and then updates his permission level
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->authorize('admin_operations');

        $user = User::findOrFail($request->promoted_user);

        $permission = $request->promotion == 3 ?: 2;

        $user->permission_id = $permission;

        $user->save();

        return redirect('/admin/permission/index')->with('success_msg', "$user->name foi promovido a um novo cargo!");
    }


    /**
     * Takes the permissions that are different from the user's permission passed by parameter and sends this object along with the user himself to a view
     * 
     * @param User $user
     * 
     * @return \Illuminate\View\View
     */
    public function change(User $user)
    {
        $this->authorize('admin_operations');

        $permissions = Permission::where('permissions.id', '!=', $user->permission_id)->get();

        return view('admin.permission.change', [
            'user' => $user,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Retrieves the user by id, saves its new position and redirects to a view
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transference(Request $request, $id)
    {
        $this->authorize('admin_operations');
        
        $user = User::findOrFail($id);
        $user->permission_id = $request->new_position;
        $user->save();

        return redirect('/admin/permission/index')->with('success_msg', "$user->name mudou de posição!");
    }
}
