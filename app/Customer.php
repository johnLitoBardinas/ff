<?php

namespace App;

use App\CustomerVisits;
use App\CustomerPackage;
use App\Http\Controllers\Api\CustomerPackageController;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Custom table name.
    protected $table = 'customer';

    // Custom table primaryKey.
    protected $primaryKey = 'customer_id';

    // Fillable  Model fields.
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    // One to Many.
    public function customer_packages()
    {
        return $this->hasMany(CustomerPackage::class, 'customer_id');
    }

}
