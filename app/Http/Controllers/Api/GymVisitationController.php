<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Requests\GymVisitation;

class GymVisitationController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Customer $customer)
    {
        $customerGymVisitation = Customer::where('customer_id', $customer->customer_id)->with('customer_packages.gym_visitation')->first();
        return $this->showOne($customerGymVisitation);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GymVisitation $request, Customer $customer)
    {
        return $request->all();
    }
}
