<?php

namespace App\Rules;

use App\Enums\BranchType;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class IsUserInGymTypeBranch implements Rule
{
    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        $user = User::where('user_id', $value)->with('branch')->first();

        if (is_null($user) || $user->branch->branch_type !== BranchType::GYM) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'User does not belong to any Gym Branch';
    }
}
