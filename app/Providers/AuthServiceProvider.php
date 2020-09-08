<?php

namespace App\Providers;

use App\Enums\UserStatus;
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

        // For admin only.
        Gate::define('access-admin', fn($user) => $user->role->name === UserType::ADMIN && $user->user_status === UserStatus::ACTIVE);

        // For management.
        Gate::define('access-management', fn($user) => in_array($user->role->name, [UserType::MANAGER, UserType::CASHIER]) && $user->user_status === UserStatus::ACTIVE);

        // Allow Admin/ Management user to access.
        Gate::define('access-user', fn($user) => in_array($user->role->name, UserType::getValues()) && $user->user_status === UserStatus::ACTIVE);
    }
}
