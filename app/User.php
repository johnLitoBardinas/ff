<?php

namespace App;

use App\Branch;
use App\CustomerPackage;
use App\CustomerVisits;
use App\Enums\BranchType;
use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    // Defining the table name.
    protected $table = 'user';

    // Defining the table primaryKey.
    protected $primaryKey = 'user_id';

    // Allowed mass assign properties.
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'mobile_number',
        'branch_id',
        'role_id',
        'api_token',
    ];

    // Guarded properties.
    protected $guarded = [
        'user_status',
        'user_type',
    ];

    // One to Many Inverse.
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    // One to Many Inverse.
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    // One to Many
    public function customer_packages()  //phpcs:ignore
    {
        return $this->hasMany(CustomerPackage::class, 'user_id');
    }

    // One to Many
    public function customer_visits()  //phpcs:ignore
    {
        return $this->hasMany(CustomerVisits::class, 'user_id');
    }

    /**
     * Determine if the user is a Super Admin Type.
     */
    public function isSuperAdmin()
    {
        return $this->role->name === UserType::SUPER_ADMIN;
    }

    /**
     * Determining if a user is a Admin.
     */
    public function isAdmin()
    {
        return $this->role->name === UserType::ADMIN;
    }

    /**
     * Determining of the user is an Manager/Cashier.
     */
    public function isManagement()
    {
        return in_array($this->role->name, [UserType::MANAGER, UserType::CASHIER]);
    }

    /**
     * Determining if the user type is a valid [admin, manager, cashier].
     */
    public function isValidUserType()
    {
        return in_array($this->role->name, UserType::getValues());
    }

    /**
     * Determining if the user is active/inactive.
     */
    public function isActive()
    {
        return $this->user_status === UserStatus::ACTIVE;
    }

    /**
     * Get the user branch type refer to BranchType Enum.
     */
    public function branchType()
    {
        return $this->branch->branch_type;
    }

    /**
     * Get the allowed User Access Page. see AccessHomeType Enum.
     */
    public function accessHomePage()
    {
        if ($this->isAdmin() || $this->isSuperAdmin()) {
            return BranchType::ADMIN;
        }

        return $this->branchType();
    }
}
