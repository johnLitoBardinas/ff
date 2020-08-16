<?php

namespace App\Rules;

use App\CustomerPackage;
use Illuminate\Contracts\Validation\Rule;

class IsCustomerHasPackage implements Rule
{
    // Customer Id.
    protected $customerId;

    // Customer Package that the user want to log a visits.
    protected $customerPackageId;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Int $customerId, Int $customerPackageId)
    {
        $this->customerId = $customerId;
        $this->customerPackageId = $customerPackageId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return CustomerPackage::where('customer_id', $this->customerId)
        ->where('customer_package_status', 'active')
        ->pluck('customer_package_id')
        ->contains($this->customerPackageId);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Customer does not own the specified Package';
    }
}
