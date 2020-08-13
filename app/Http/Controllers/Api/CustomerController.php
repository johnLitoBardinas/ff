<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customerData = $request->validate([
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191']
        ]);

        $customer = Customer::create($customerData);

        return $this->showOne($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return $this->showOne($customer);
    }

}
