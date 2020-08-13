<?php

namespace App;

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

}
