<?php

namespace App;

use App\CustomerVisits;
use App\CustomerPackage;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    // One Customer Model can appear to Many CustomerPackage.
    public function package()
    {
        return $this->hasMany(CustomerPackage::class, 'customer_id', 'customer_id');
    }

    // One Customer can appear to Many CustomerVisits.
    public function visits()
    {
        return $this->hasMany(CustomerVisits::class, 'customer_id', 'customer_id');
    }

}
