<?php

namespace App\Rules;

use App\Enums\UserStatus;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class IsActive implements Rule
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
        $user = User::whereEmail($value)->first();

        if (is_null($user))
        {
            return false;
        }

        return $user->user_status === UserStatus::ACTIVE;
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Invalid User';
    }
}
