<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymVisitation extends Model
{
    protected $table = 'gym_visitation';

    // Fillable Properties.
    protected $fillable = [
        'customer_package_id',
        'current_branch',
        'user_id',
        'visitation_type',
        'date',
    ];

    // Disabling the default created_at, updated_at.
    public $timestamps = false;

    // One to Many (Inverse)
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'current_branch');
    }

    // One to Many (Inverse)
    public function customer_package() //phpcs:ignore
    {
        return $this->belongsTo(Branch::class, 'customer_package_id');
    }

    // One to Many (inverse)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
