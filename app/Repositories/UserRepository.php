<?php

namespace App\Repositories;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
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
