<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerPackage;
use Illuminate\Http\Request;

class CustomerPackageController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Customer $customer)
    {
        return $this->showAll($customer::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Customer $customer)
    {
        dd($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerPackage  $customerPackag
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerPackage $customerPackage)
    {
        //
    }

}
