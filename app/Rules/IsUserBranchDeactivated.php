<?php

namespace App\Rules;

use App\Enums\BranchStatus;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class IsUserBranchDeactivated implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
    }

    /**
     * Determine if the user Branch is Active in the moment.
     */
    public function passes($attribute, $value)
    {
        $userId = User::whereEmail($value)->first()->user_id;

        if (empty($userId))
        {
            return false;
        }

        return User::find($userId)->branch->branch_status === BranchStatus::ACTIVE;
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'The user branch is deactivated.';
    }
}
