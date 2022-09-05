<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class PostPolicy
{
    use HandlesAuthorization;

    public function create()
    {
        return Auth::check();
    }

    public function update(User $user, Post $post)
    {
        return $post->user_id === $user->id;
    }

    public function delete(User $user, Post $post)
    {
        return $post->user_id === $user->id;
    }
}
