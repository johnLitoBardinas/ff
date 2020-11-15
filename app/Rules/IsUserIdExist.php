<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class IsUserIdExist implements Rule
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
        return User::where('user_id', $value)->exists();
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'User Id is Invalid';
    }
}
