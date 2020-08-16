<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerPackage;
use App\Http\Requests\CustomerPackage as RequestsCustomerPackage;

class CustomerPackageController extends ApiController
{
    /**
     * Display a listing of the Customer Package Resource.
     */
    public function index(Customer $customer)
    {
        return $this->showAll(Customer::where('customer_id', $customer->customer_id)->with('package')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsCustomerPackage $request, Customer $customer)
    {
        $customerPackage = CustomerPackage::create([
            'user_id' => $request->user_id,
            'branch_id' => $request->branch_id,
            'customer_id' => $customer->customer_id,
            'reference_no' => $request->reference_no,
            'payment_type' => $request->payment_type,
            'package_id' => $request->package_id
        ]);
        return $this->showOne($customerPackage);
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerPackage $customerPackage)
    {

    }

}
