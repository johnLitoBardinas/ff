<?php

namespace App\Rules;

use App\Enums\UserStatus;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class IsUserActiveById implements Rule
{
    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        $user = User::where('user_id', $value)->first();

        if (is_null($user) || $user->user_status !== UserStatus::ACTIVE) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Invalid User';
    }
}
