<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    protected $primaryKey = 'role_id';

    protected $fillable = [ 'name' ];

    public function user()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
