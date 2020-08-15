<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';

    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'branch_code',
        'branch_name',
        'branch_address',
    ];

    // One Branch Model can be related to multiple User Model.
    public function users()
    {
        return $this->hasMany(User::class, 'branch_id', 'branch_id');
    }
}
