<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = 'barangay';

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
}
