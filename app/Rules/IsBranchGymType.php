<?php

namespace App\Rules;

use App\Branch;
use App\Enums\BranchType;
use Illuminate\Contracts\Validation\Rule;

class IsBranchGymType implements Rule
{
    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        $branch = Branch::where('branch_id', $value)->first();

        if (is_null($branch) || $branch->branch_type !== BranchType::GYM) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'The branch type is not gym';
    }
}
