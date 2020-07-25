<?php

namespace App;

use App\Branch;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'region';

    /**
     * One Region can be present in (n) Branch Model.
     */
    public function branch()
    {
        return $this->hasMany(Branch::class, 'region_code', 'region_code');
    }

    /**
     * One Region can be present in (n) Province Model.
     */
    public function province()
    {
        return $this->hasMany(Province::class, 'region_code', 'region_code');
    }


}
