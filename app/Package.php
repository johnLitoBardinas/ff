<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

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
