<?php

namespace App\Rules;

use App\CustomerPackage;
use Illuminate\Contracts\Validation\Rule;

class IsCustomerHasPackage implements Rule
{
    // Customer Id.
    protected $customerId;

    // Filtering PackageStatus.
    protected $packageStatus;

    /**
     * Create a new rule instance.
     */
    public function __construct(int $customerId, string $packageType)
    {
        $this->customerId = $customerId;
        $this->packageStatus = $packageType . '_package_status';
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        return CustomerPackage::where('customer_id', $this->customerId)
            ->where($this->packageStatus, 'active')
            ->pluck('customer_package_id')
            ->contains($value);
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Customer does not own the specified Package';
    }
}
