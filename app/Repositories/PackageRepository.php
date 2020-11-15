<?php

namespace App\Repositories;

use App\Enums\PackageStatus;
use App\Package;

class PackageRepository
{
    /**
     * Getting the packages in GYM, SPA, SALON also ACTIVE and INACTIVE
     *
     * @param String $packageType salon, gym, spa.
     *
     * @return Array|Collection|null
     */
    public static function getAll(string $packageType)
    {
        return Package::where('package_type', $packageType)->get();
    }

    /**
     * Getting the list of active Package Status.
     *
     * @param String $packageType salon, gym, spa.
     *
     * @return Array|Collection|null
     */
    public static function getAllActive(string $packageType)
    {
        return Package::where('package_status', PackageStatus::ACTIVE)->where('package_type', $packageType)->get();
    }
}
