<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerVisits extends Model
{
    protected $table = 'customer_visits';

    protected $primaryKey = 'customer_visits_id';

    protected $fillable = [ 'date' ];
}
