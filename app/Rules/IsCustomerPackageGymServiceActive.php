<?php

namespace App\Rules;

use App\CustomerPackage;
use App\Enums\PackageType;
use Illuminate\Contracts\Validation\Rule;

class IsCustomerPackageGymServiceActive implements Rule
{
    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        $customerPackage = CustomerPackage::where('customer_package_id', $value)->with('package')->first();

        if (is_null($customerPackage)) {
            return false;
        }

        $packageType = $customerPackage->package->package_type;

        if ($packageType === PackageType::GYM) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
