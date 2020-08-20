<?php

namespace App\Rules;

use App\CustomerVisits;
use Illuminate\Contracts\Validation\Rule;

class IsCustomerPackageAvailableToVisit implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        return CustomerVisits::where('customer_package_id', $value)->count() < config('constant.package_visits_limit');
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Visitation for this package is exceeded.';
    }
}
