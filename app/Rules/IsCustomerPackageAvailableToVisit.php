<?php

namespace App\Rules;

use App\CustomerVisits;
use Illuminate\Contracts\Validation\Rule;

class IsCustomerPackageAvailableToVisit implements Rule
{
    private $packageVisitsLimit;

    /**
     * Create a new rule instance.
     */
    public function __construct(int $packageVisitsLimit)
    {
        $this->packageVisitsLimit = $packageVisitsLimit;
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        return CustomerVisits::where('customer_package_id', $value)->count() < $this->packageVisitsLimit;
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Visitation for this package is exceeded.';
    }
}
