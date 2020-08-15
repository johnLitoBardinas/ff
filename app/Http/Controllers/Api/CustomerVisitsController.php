<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use Illuminate\Http\Request;

class CustomerVisitsController extends ApiController
{
    /**
     * Display a listing of the customer visits resource.
     */
    public function index(Customer $customer)
    {
        dd($customer);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Customer $customer)
    {
        $rules = [
            'customer_package_id' => $request->customer_package_id,
            'customer_id' => $customer->customer_id,
            'branch_id' => $request->branch_id,
            'user_id' => $request->user_id,
        ];

        if ($request->has('customer_associate')) {
            $rules['customer_associate'] = $request->customer_associate;
        }

        if($request->has('customer_associate_picture')) {
            $rules['customer_associate_picture'] = $request->customer_associate_picture;
        }

        $validCustomerVisits = $request->validate($rules);


        dd($validCustomerVisits);
    }
}
