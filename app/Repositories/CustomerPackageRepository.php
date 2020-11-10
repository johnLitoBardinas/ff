<?php

namespace App\Repositories;

use App\CustomerPackage;
use App\CustomerVisits;
use Carbon\Carbon;

class CustomerPackageRepository
{
    /**
     * getting all packages via type and package type.
     *
     * @param String $type  (all, active, notActive) default all
     * @param String $packageType (salon,gym,spa)
     *
     * @return Collection|null
     */
    public static function getOne(int $customerPackageId)
    {
        return CustomerPackage::where('customer_package_id', $customerPackageId)->with('customer', 'package', 'customer_visits')->first();
    }

    /**
     * getting all packages via type and package type.
     *
     * @param String $type  (all, active, notActive) default all
     * @param String $packageType (salon,gym,spa)
     *
     * @return Collection|null
     */
    public static function getAll()
    {
        $customerPackage = CustomerPackage::query();
        $customerPackage->orderBy('customer_package_id', 'desc');

        $customerPackage->with('customer', 'package', 'customer_visits', 'branch', 'user');
        $customerPackage->with(['gym_visitation' => fn ($query) => $query->whereDate('date', Carbon::today())]);

        return $customerPackage->take(50)->get();
    }

    /**
     * Getting the total allowed visitation for a specific package.
     *
     * @param int $customerPackageId Customer Package Id
     * @param String $packageType (salon,gym,spa)
     *
     * @return int|null
     */
    public static function totalVisitation(int $customerPackageId, string $packageType)
    {
        $packageTypeField = sprintf('%s_no_of_visits', $packageType);
        return CustomerPackage::where('customer_package_id', $customerPackageId)->with('package')->first()->package->$packageTypeField;
    }

    /**
     * Getting the total allowed visitation for a specific package.
     *
     * @param int $customerPackageId Customer Package Id
     * @param String $packageType (salon,gym,spa)
     *
     * @return int|null
     */
    public static function packageEndDate(int $customerPackageId, string $packageType)
    {
        $packageEndType = sprintf('%s_package_end', $packageType);
        return CustomerPackage::where('customer_package_id', $customerPackageId)->first()->$packageEndType;
    }

    /**
     * Getting the current count from the customer package according to their type.
     *
     * @param int $customerPackageId Customer Package Id
     * @param String $packageType (salon,gym,spa)
     *
     * @return Array|null
     */
    public static function customerTotalVisits(int $customerPackageId, string $packageType)
    {
        return CustomerVisits::where('customer_package_id', $customerPackageId)->where('package_type', $packageType)->get()->toArray();
    }
}
