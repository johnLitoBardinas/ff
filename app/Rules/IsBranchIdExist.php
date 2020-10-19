<?php

namespace App\Rules;

use App\Branch;
use Illuminate\Contracts\Validation\Rule;

class IsBranchIdExist implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        return Branch::where('branch_id', $value)->exists();
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Branch Id Does not Exist';
    }
}
