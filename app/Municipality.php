<?php

namespace App;

use App\Branch;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = 'municipality';

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
}
