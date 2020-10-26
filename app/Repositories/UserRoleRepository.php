<?php

namespace App\Repositories;

use App\Enums\UserType;
use App\Role;
use Illuminate\Database\Eloquent\Collection;

class UserRoleRepository
{
    /**
     * Getting the list of User Role
     *
     * @return Collection|null
     */
    public static function getAll()
    {
        return Role::where('name', '!=', UserType::SUPER_ADMIN)->get();
    }
}
