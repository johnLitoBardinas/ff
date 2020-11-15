<?php

namespace App\Rules;

use App\CustomerPackage;
use App\Enums\PackageType;
use App\Repositories\CustomerPackageRepository;
use Illuminate\Contracts\Validation\Rule;

class IsCustomerPackageAvailableToVisit implements Rule
{
    private $packageType;

    /**
     * Create a new rule instance.
     */
    public function __construct(string $packageType)
    {
        $this->packageType = $packageType;
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        $customerPackage = CustomerPackage::find($value);

        // Package Type is Gym make sure the service is not expired
        if ($this->packageType === PackageType::GYM && ! $customerPackage->isGymServiceExpired()) {
            return true;
        }

        return CustomerPackageRepository::totalVisitation($value, $this->packageType) > count(CustomerPackageRepository::customerTotalVisits($value, $this->packageType));
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Visitation for this package is exceeded.';
    }
}
