<?php

namespace App;

use App\Role;
use App\Branch;
use App\Enums\UserStatus;
use App\Enums\UserType;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

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
        'api_token'
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
    public function customer_packages()
    {
        return $this->hasMany(CustomerPackage::class, 'user_id');
    }

    // One to Many
    public function customer_visits()
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

    public function branchType()
    {
        return $this->branch->branch_type;
    }

}
