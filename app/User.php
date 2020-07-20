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
     * Determine if the user is admin
     */
    public function isAdmin()
    {
       return $this->user_type === UserType::ADMIN;
    }

    /**
     * Determining if user is active of inactive.
     */
    public function isActive()
    {
       return $this->user_status === UserStatus::ACTIVE;
    }

}
