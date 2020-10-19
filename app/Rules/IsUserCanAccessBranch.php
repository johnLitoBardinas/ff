<?php

namespace App\Rules;

use App\Enums\AccessHomeType;
use App\Enums\BranchType;
use App\User as AppUser;
use Illuminate\Contracts\Validation\Rule;

class IsUserCanAccessBranch implements Rule
{
    protected $user;

    private $homeType;

    /**
     * Determine if the current user can access the specified branch.
     */
    public function __construct(string $homeType)
    {
        $this->homeType = $homeType;
    }

    /**
     * Determine if the user can access the branch
     */
    public function passes($attribute, $value)
    {
        $this->user = AppUser::whereEmail($value)->first();

        if ($this->user->accessHomePage() === BranchType::ADMIN && $this->homeType !== AccessHomeType::FFCO) {
            return false;
        }

        if ($this->user->accessHomePage() === BranchType::ADMIN && $this->homeType === AccessHomeType::FFCO) {
            return true;
        }

        return $this->user->branchType() === get_account_home_page($this->homeType);
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Invalid User Account Type';
    }
}
