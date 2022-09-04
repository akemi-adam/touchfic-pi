<?php

namespace App\Policies;

use App\Models\Storie;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;
use Auth;

class StoriePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if (Auth::user()->id === $user->id && isset($user->email_verified_at)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Storie  $storie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Storie $storie)
    {
        if (!(Auth::user()->id === $user->id)) {
            return false;
        }
        if (count(DB::table('storie_user')->where('storie_id', $storie->id)->where('user_id', $user->id)->get())) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Storie  $storie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Storie $storie)
    {
        if (!(Auth::user()->id === $user->id)) {
            return false;
        }
        if (count(DB::table('storie_user')->where('storie_id', $storie->id)->where('user_id', $user->id)->get())) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Storie  $storie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Storie $storie)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Storie  $storie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Storie $storie)
    {
        //
    }
}
