<?php

namespace App;

use App\Branch;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'region';

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
}
