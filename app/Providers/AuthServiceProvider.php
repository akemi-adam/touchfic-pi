<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\StoriePolicy;
use App\Models\Storie;
use App\Models\User;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Storie::class => StoriePolicy::class,
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
            return $user->permission_id === 3;
        });

        Gate::define('authenticated', function ()
        {
            return Auth::check();
        });
    }
}
