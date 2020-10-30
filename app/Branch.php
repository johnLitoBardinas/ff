<?php

namespace App;

use App\CustomerPackage;
use App\CustomerVisits;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    // Implementing Soft Deletes.
    use SoftDeletes;

    // Defining the table name.
    protected $table = 'branch';

    // Defining the table primary Key.
    protected $primaryKey = 'branch_id';

    // Mass assigned filled.
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
    public function customer_packages() //phpcs:ignore
    {
        return $this->hasMany(CustomerPackage::class, 'branch_id');
    }

    // One Branch Model can be related to (n) of CustomerVisits Model.
    public function customer_visits() //phpcs:ignore
    {
        return $this->hasMany(CustomerVisits::class, 'branch_id');
    }

    // One Branch Model can be related to (n) of GymVisitation Model.
    public function gym_visitation() //phpcs:ignore
    {
        return $this->hasMany(GymVisitation::class, 'branch_id', 'current_branch');
    }
}
