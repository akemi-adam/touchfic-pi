<?php

namespace App\Policies;

use App\Models\Chapter;
use App\Models\Storie;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;
use Auth;

class ChapterPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Storie $storie)
    {
        if (!Auth::check()) {
            return false;
        }

        if (count(DB::table('storie_user')->where('storie_id', $storie->id)->where('user_id', $user->id)->get()) === 0) {
            return false;
        }

        if (is_null($user->email_verified_at)) {
            return false;
        }

        return true;
    }


    public function update(User $user, Chapter $chapter)
    {
        if (!Auth::check()) {
            return false;
        }

        if (count(DB::table('storie_user')->where('storie_id', $chapter->storie_id)->where('user_id', $user->id)->get()) === 0) {
            return false;
        }

        if (Storie::where('id', $chapter->storie_id)->get() === 0) {
            return false;
        }

        return true;
    }

    public function delete(User $user, Chapter $chapter)
    {
        if (!Auth::check()) {
            return false;
        }

        if (count(DB::table('storie_user')->where('storie_id', $chapter->storie_id)->where('user_id', $user->id)->get()) === 0) {
            return false;
        }

        if (Storie::where('id', $chapter->storie_id)->get() === 0) {
            return false;
        }

        return true;
    }
}
