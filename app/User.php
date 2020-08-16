<?php

namespace App;

use App\Role;
use App\Branch;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'user';

    protected $primaryKey = 'user_id';

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
}
