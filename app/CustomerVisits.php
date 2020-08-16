<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerVisits extends Model
{
    // Disabling the default timestamp.
    public $timestamps = false;

    // override table name.
    protected $table = 'customer_visits';

    // setting the custom primaryKey Table.
    protected $primaryKey = 'customer_visits_id';

    // Many Row in Customer Visits can be related to ONE Customer.
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // ONE to Many (Inverse) Customer Package
    public function customer_package()
    {
        return $this->belongsTo(CustomerPackage::class);
    }

}
