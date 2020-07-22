<?php

namespace App;

use App\Branch;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'province';

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
}
