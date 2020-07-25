<?php

namespace App;

use App\Branch;
use App\Municipality;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'province';

    /**
     * One Province can have (n) Branch Model.
     */
    public function branch()
    {
        return $this->hasMany(Branch::class, 'province_code', 'province_code');
    }

    /**
     * (n) of Province belongs to a "SINGLE" Province Model.
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_code', 'region_code');
    }

    /**
     * One Province can have (n) Municipality Model.
     */
    public function municipality()
    {
        return $this->hasMany(Municipality::class, 'province_code', 'province_code');
    }

}
