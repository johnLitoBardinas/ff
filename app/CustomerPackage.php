<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPackage extends Model
{

    // Disabling the default created_at, updated_at.
    public $timestamps = false;

    // Model custom table name.
    protected $table = 'customer_package';

    // Model custom table primary key.
    protected $primaryKey = 'customer_package_id';

    // Fillable Model Fields.
    protected $fillable = [
        'branch_id',
        'package_id',
        'user_id',
        'customer_id',
        'reference_no',
        'payment_type',
        'salon_package_status', // Salon Package Status
        'salon_package_start', // Salon Start Date
        'salon_package_end', // Salon End Date
        'gym_package_status', // Gym Package Status
        'gym_package_start', // Gym Package Start Date
        'gym_package_end', // Gym Package End Date
        'spa_package_status', // Spa Package Status
        'spa_package_start', // Spa Start Date
        'spa_package_end', // Spa End Date
    ];

    // One CustomerPackage Row can be in Many CustomerVisits.
    public function customer_visits()
    {
        return $this->hasMany(CustomerVisits::class, 'customer_package_id');
    }

    // One to Many Inverse.
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    // One to Many Inverse.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // One to Many (Inverse)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // One to Many (Inverse)
    public function package()
    {
       return $this->belongsTo(Package::class, 'package_id');
    }

}
