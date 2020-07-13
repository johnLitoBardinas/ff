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
     * Dynamic Scope for retrieving only the active/inactive user_status
     * App\User::isUserTypeOf( 'admin'|'manager'|'cashier' )->...
     */
    public function scopeisUserTypeOf( $query, UserType $type )
    {
        if ( $type->in( [ UserType::ADMIN, UserType::MANAGER, UserType::CASHIER ] ) ) {
            return $query->where( 'user_type', $type );
        }
    }

    /**
     * Dynamic Scope: for retreiving admin, manager, cashier User_Type.
     * App\User::isUserStatusOf( 'active' | 'inactive' )->...
     */
    public function scopeisUserStatusOf( $query, UserStatus $status )
    {
        if ( $status->in( [ UserStatus::ACTIVE, UserStatus::INACTIVE ] ) ) {
            return $query->where( 'user_status', $status );
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name',
    ];

    /**
     * The attributes that are guarded
     *
     * @var array
     */
    protected $guarded = [ 'user_status', 'user_type' ];

}
