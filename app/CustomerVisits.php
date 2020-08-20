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

    protected $fillable = [
        'customer_package_id',
        'branch_id',
        'user_id',
        'date',
        'customer_associate',
        'customer_associate_picture',
    ];

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

    // One to Many (inverse)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // One to Many (Inverse)
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function customer_visits()
    {
        return $this->belongsTo(CustomerPackage::class, 'customer_package_id');
    }

}
