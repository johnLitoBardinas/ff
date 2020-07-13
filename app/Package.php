<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';

    protected $primaryKey = 'package_id ';

    protected $fillable = [
        'package_name',
        'package_description',
        'package_price',
    ];
}
