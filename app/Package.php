<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    // Implementing the SoftDeletes.
    use SoftDeletes;

    // Defining the table name.
    protected $table = 'package';

    // Defining the table primarKey.
    protected $primaryKey = 'package_id';

    // Fillable Model fields.
    protected $fillable = [
        'package_name',
        'package_price',
        'package_type',
        'salon_no_of_visits',
        'salon_days_valid_count',
        'gym_no_of_visits',
        'gym_days_valid_count',
        'spa_no_of_visits',
        'spa_days_valid_count',
    ];

    public function customer_packages()
    {
        return $this->hasMany(CustomerPackage::class, 'package_id');
    }


}
