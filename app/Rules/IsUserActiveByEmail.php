<?php

namespace App\Rules;

use App\Enums\UserStatus;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class IsUserActiveByEmail implements Rule
{
    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        $user = User::whereEmail($value)->first();
        if (is_null($user)) {
            return false;
        }

        return $user->user_status === UserStatus::ACTIVE;
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Invalid User email';
    }
}
