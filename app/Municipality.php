<?php

namespace App;

use App\Branch;
use App\Barangay;
use App\Province;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = 'municipality';

    public function branch()
    {
        return $this->hasMany(Branch::class, 'municipality_code', 'municipality_code');
    }

    /**
     * (n) of Municipality belongs to a "SINGLE" Province Model.
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'province_code');
    }

    /**
     * One Province can have (n) Municipality Model.
     */
    public function barangay()
    {
        return $this->hasMany(Barangay::class, 'municipality_code', 'municipality_code');
    }

}
