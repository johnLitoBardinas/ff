<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = 'barangay';

    /**
     * One Barangay can have (n) Branch Model.
     */
    public function branch()
    {
        return $this->hasMany(Branch::class, 'psgc_code', 'barangay_psgc');
    }

    /**
     * (n) of Municipality belongs to a "SINGLE" Province Model.
     */
    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_code', 'municipality_code');
    }

}
