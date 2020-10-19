<?php

namespace App\Repositories;

use App\CustomerVisits;
use App\CustomerPackage;

/**
 * Main Purpose of this class is to supply all the information related to Customer Visits
 * Act like the middle between Controller and Model.
 */

class CustomerVisitsRepository
{

    /**
     * Getting the current count of Customer Visitation for the Package.
     */
    public function getCustomerTotalCurrentPackageVisitation(int $customerPackageId, string $packageType)
    {
        return CustomerVisits::where('customer_package_id', $customerPackageId)->where('package_type', $packageType)->count();
    }

    /**
     * Get the total Count of Visits for the Package to Visits.
     */
    public function customerPackageVisitationLimit(int $customerPackageId, string $packageType)
    {
        $packageTypeNoOfVisits = $packageType . '_no_of_visits';
        return CustomerPackage::where('customer_package_id', $customerPackageId)->with('package')->first()->package->$packageTypeNoOfVisits;
    }
}
