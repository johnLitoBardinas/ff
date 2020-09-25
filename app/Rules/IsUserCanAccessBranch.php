<?php

namespace App\Rules;

use App\Enums\AccessHomeType;
use App\Enums\BranchType;
use App\User as AppUser;
use Illuminate\Contracts\Validation\Rule;

class IsUserCanAccessBranch implements Rule
{
    public $homeType;

    /**
     * Create a new rule instance.
     */
    public function __construct(String $homeType)
    {
        switch ($homeType) {
            case AccessHomeType::FFCO:
                $this->homeType = 'admin';
                break;

            case AccessHomeType::FFSALON:
                $this->homeType = BranchType::SALON;
                break;

            case AccessHomeType::FFGYM:
                $this->homeType = BranchType::GYM;
                break;

            case AccessHomeType::FFWELLNESS:
                $this->homeType = BranchType::SPA;
                break;
        }
    }

    /**
     * Determine if the user can access the branch
     */
    public function passes($attribute, $value)
    {
        $user = AppUser::whereEmail($value)->first();
        if ( $this->homeType === 'admin' && $user->isAdmin() || $user->isSuperAdmin() ) return true;
        return AppUser::find($user->user_id)->branch->branch_type === $this->homeType;
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Invalid User Account Type';
    }
}
