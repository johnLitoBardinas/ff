<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerVisits extends Model
{
    protected $table = 'customer_visits';

    protected $primaryKey = 'customer_visits_id';

    // Many Row in Customer Visits can be related to ONE Customer.
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
