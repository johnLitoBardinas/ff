<?php

namespace App\Repositories;

use App\Customer;

class CustomerRepository
{
    /**
     * Getting the list of active Package Status.
     *
     * @param String $name customer first name or last name.
     *
     * @return Array|Collection|null
     */
    public static function searchCustomerId(string $name)
    {
        return Customer::where('first_name', 'LIKE', '%' . trim($name) . '%')->orWhere('last_name', 'LIKE', '%' . trim($name) . '%')->pluck('customer_id')->toArray();
    }
}
