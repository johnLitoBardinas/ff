<?php

namespace App\Repositories;

use App\Enums\PackageStatus;
use App\Package;

class PackageRepository
{
    /**
     * Getting the list of User Role
     *
     * @param String $packageType salon, gym, spa.
     *
     * @return Array|Collection|null
     */
    public static function getAll(string $packageType)
    {
        return Package::where('package_status', PackageStatus::ACTIVE)->where('package_type', $packageType)->get();
    }
}
