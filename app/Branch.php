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

    public function user()
    {
        return $this->hasMany(User::class, 'branch_id', 'branch_id');
    }

}
