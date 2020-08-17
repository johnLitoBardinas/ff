<?php

namespace App;

use App\Http\Controllers\Api\CustomerPackageController;
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
        'package_description',
        'package_price',
    ];

    // One Package Model can be related To Many Customer
    public function customers()
    {
        return $this->belongsToMany('App\Customer', 'customer_package', 'customer_id', 'customer_id');
    }
}
