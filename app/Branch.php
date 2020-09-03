<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $table = 'branch';

    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'branch_code',
        'branch_name',
        'branch_address',
        'branch_type',
    ];

    // One Branch Model can be related to multiple User Model.
    public function users()
    {
        return $this->hasMany(User::class, 'branch_id');
    }

    // One to Many Relationship Branch -> Customer Package.
    public function customer_packages()
    {
        return $this->hasMany(CustomerPackage::class, 'branch_id');
    }

    // One Branch Model can be related to (n) of CustomerVisits Model.
    public function customer_visits()
    {
        return $this->hasMany(CustomerVisits::class, 'branch_id');
    }

}
