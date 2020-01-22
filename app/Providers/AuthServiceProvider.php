<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Define Gates
        Gate::define('edit-users', function ($user){  //$user current login user
            return $user->hasRole('admin');
        });

        Gate::define('delete-users', function ($user){  //$user current login user

            //return $user->hasRole('admin');
            return $user->hasAnyRoles(['admin','author']);
        });

        //generic user  restric/hide the UI by using middleware
        Gate::define('manage-users', function ($user){  //$user current login user
            return $user->hasAnyRoles(['admin','author']);
        });

    }
}
