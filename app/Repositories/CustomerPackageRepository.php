<?php

namespace App\Repositories;

use App\CustomerPackage;

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
    public static function getAll(string $type, string $packageType)
    {
        $accountPackageStatusFilter = sprintf('%s_package_status', $packageType);

        $customerPackage = CustomerPackage::query();
        $customerPackage->orderBy('customer_package_id');

        if ($type === 'notActive') {
            $customerPackage->where($accountPackageStatusFilter, '!=', 'active');
        } elseif ($type === 'active') {
            $customerPackage->where($accountPackageStatusFilter, 'active');
        }

        $customerPackage->with('customer', 'package', 'customer_visits', 'branch', 'user');

        return $customerPackage->get()->filter(fn ($customerPackage) => $customerPackage->branch->branch_type === $packageType)->values();
    }
}
