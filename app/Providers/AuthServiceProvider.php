<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\{
    StoriePolicy, UserPolicy, PostPolicy, ChapterPolicy
};
use App\Models\{
    Storie, User, Post, Chapter
};
use App\Enums\UserRole;
use Auth, Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Storie::class => StoriePolicy::class,
        User::class => UserPolicy::class,
        Post::class => PostPolicy::class,
        Chapter::class => ChapterPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin_operations', function (User $user)
        {
            return $user->permission_id === UserRole::ADMIN;
        });

        Gate::define('authenticated', function ()
        {
            return Auth::check();
        });
    }
}
