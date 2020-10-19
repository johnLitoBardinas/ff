<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerPackage;
use App\Http\Requests\CustomerPackage as RequestsCustomerPackage;
use App\Package;
use Carbon\Carbon;

class CustomerPackageController extends ApiController
{
    /**
     * Displaying the Customer with its packages.
     */
    public function index(Customer $customer)
    {
        $customerWithPackages = Customer::where('customer_id', $customer->customer_id)->with('packages')->get();
        return $this->showAll($customerWithPackages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsCustomerPackage $request, Customer $customer)
    {
        // Get the Package Model here..
        $chosenPackage = Package::findOrFail($request->package_id);

        $customerPackage = CustomerPackage::create([
            'branch_id' => $request->branch_id,
            'package_id' => $request->package_id,
            'user_id' => $request->user_id,
            'customer_id' => $request->customer_id,
            'reference_no' => $request->reference_no,
            'payment_type' => $request->payment_type,
            'salon_package_start' => Carbon::now(),
            'salon_package_end' => Carbon::now()->addDays($chosenPackage->salon_days_valid_count + 1), // + 1 So that the last day will be consumable
            'gym_package_start' => Carbon::now(),
            'gym_package_end' => Carbon::now()->addDays($chosenPackage->gym_days_valid_count + 1),
            'spa_package_start' => Carbon::now(),
            'spa_package_end' => Carbon::now()->addDays($chosenPackage->spa_days_valid_count + 1),
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
