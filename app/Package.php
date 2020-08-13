<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';

    protected $primaryKey = 'package_id';

    protected $fillable = [
        'package_name',
        'package_description',
        'package_price',
    ];

    public function customer()
    {
        return $this->hasMany(CustomerPackage::class, 'customer_id', 'customer_id');
    }
}
