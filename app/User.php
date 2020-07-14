<?php

namespace App;

use App\Enums\UserStatus;
use App\Enums\UserType;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
    ];

    /**
     * The attributes that are guarded
     *
     * @var array
     */
    protected $guarded = [
        'user_status',
        'user_type'
    ];

    /**
     * Dynamic Scope for retrieving only the active/inactive user_status
     * App\User::isUserTypeOf( 'admin'|'manager'|'cashier' )->...
     */
    public function scopeisUserTypeOf($query, UserType $type)
    {
        if ( is_valid_usertype( $type ) ) {
            return $query->where('user_type', $type);
        }
    }

    /**
     * Dynamic Scope: for retreiving admin, manager, cashier User_Type.
     * App\User::isUserStatusOf( 'active' | 'inactive' )->...
     */
    public function scopeisUserStatusOf($query, UserStatus $status)
    {
        if ( is_valid_user_status( $status ) ) {
            return $query->where('user_status', $status);
        }
    }

    /**
     * Checking if the user has the Valid Rules.
     */
    public function hasRolesOf(array $types)
    {
        return (boolean) $this
            ->whereIn( 'user_type', $types )
            ->where( 'user_status', UserStatus::ACTIVE )
            ->first();
    }

    /**
     * Checking if single role below to a user.
     */
    public function hasRole(UserType $type)
    {
        if ( is_valid_usertype( $type ) ) {
            return (boolean) $this
                ->where( 'user_type', $type )
                ->where( 'user_status', UserStatus::ACTIVE )
                ->first();
        }

        return false;

    }
}
