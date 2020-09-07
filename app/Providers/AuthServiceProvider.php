<?php

namespace App\Providers;

use App\Enums\UserType;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-admin', fn($user) => $user->role->name === UserType::ADMIN);

        Gate::define('access-management', fn($user) => in_array($user->role->name, [UserType::MANAGER, UserType::CASHIER]));
    }
}
