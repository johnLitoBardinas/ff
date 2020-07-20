<?php

namespace App\Rules;

use App\Enums\UserStatus;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class IsActive implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute [email field]
     * @param  mixed  $value [email field value]
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::whereEmail($value)->first();
        return $user->user_status === UserStatus::ACTIVE;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid User';
    }
}
