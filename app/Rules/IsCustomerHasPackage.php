<?php

namespace App\Rules;

use App\CustomerPackage;
use Illuminate\Contracts\Validation\Rule;

class IsCustomerHasPackage implements Rule
{
    // Customer Id.
    protected $customerId;

    /**
     * Create a new rule instance.
     */
    public function __construct(Int $customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        return CustomerPackage::where('customer_id', $value)
        ->where('customer_package_status', 'active')
        ->pluck('customer_package_id')
        ->contains($this->customerPackageId);
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Customer does not own the specified Package';
    }
}
