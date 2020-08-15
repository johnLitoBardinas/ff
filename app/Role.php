<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    protected $primaryKey = 'role_id';

    protected $fillable = [ 'name' ];

    // One to Many (1{Role} : n{User})
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
