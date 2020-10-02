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

        // Gate for Super Admin
        Gate::define('access-superadmin', fn($user) => $user->isSuperAdmin() && $user->isActive());

        // For admin only.
        Gate::define('access-admin', fn($user) => $user->isAdmin() || $user->isSuperAdmin() && $user->isActive());

        // For management.
        Gate::define('access-management', fn($user) => $user->isManagement() && $user->isActive());

        // Allow Admin/ Management user to access.
        Gate::define('access-user', fn($user) => $user->isValidUserType() && $user->isActive());
    }
}
