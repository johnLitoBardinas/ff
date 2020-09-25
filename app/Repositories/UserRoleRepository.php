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
     * @param String $type
     * @return Role[]|Collection|string
     */
    public static function all(String $type)
    {
        $userRoles = Role::where('name', '!=', UserType::SUPER_ADMIN)->get();

        if ( $type === 'json' ) {
            return $userRoles->toJson();
        }

        return $userRoles;
    }


}
