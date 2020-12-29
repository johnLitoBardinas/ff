<?php

namespace App\Http\Controllers\Api;

use App\CustomerPackage;
use App\CustomerVisits;

class CustomerReference extends ApiController
{
    /**
     * Exclude the index method for auth:santum.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
    }

    /**
     * Accept the incoming Reference NO.
     */
    public function index(string $refno)
    {
        $data = CustomerPackage::where('reference_no', $refno)->with('customer', 'package', 'customer_visits', 'gym_visitation', 'user')->first();

        if (is_null($data)) {
            return $this->errorResponse('Invalid Reference No', 404);
        }

        // query the customer visits
        $customerVisits = CustomerVisits::where('customer_package_id', $data->customer_package_id)->get()->groupBy('package_type');
        $fdata = collect($data)->put('customer_visits', $customerVisits);

        return $fdata;
    }
}
