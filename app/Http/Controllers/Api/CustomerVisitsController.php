<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerPackage;
use App\CustomerVisits;
use Illuminate\Http\Request;
use App\Rules\IsCustomerHasPackage;

class CustomerVisitsController extends ApiController
{
    /**
     * Display a listing of the customer visits resource.
     */
    public function index(Customer $customer)
    {
        /**
         * Customers + Customer Packages + Package
         * Customer + Customer Packages + Customer Visits Data.
         */
        $customerVisits = Customer::where('customer_id', 1)->with('customer_packages.package', 'customer_packages.customer_visits')->get();
        return $this->showAll($customerVisits);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Customer $customer)
    {
        if( ! $request->has('customer_package_id') || empty( $request->customer_package_id ) ) {
            return $this->errorResponse('Invalid Data', 422);
        }

        $this->isCustomerOwnthePackagePlan($customer, $request->customer_package_id);

        $rules = [
            'customer_package_id' => ['required', 'integer', new IsCustomerHasPackage($customer->customer_id, request('customer_package_id'))],
            'branch_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
        ];

        $request->validate($rules);

        $customerVisitsData = [];

        $customerVisitsData['customer_package_id'] = request('customer_package_id');
        $customerVisitsData['branch_id'] = request('branch_id');
        $customerVisitsData['user_id'] = request('user_id');

        if ($request->has('customer_associate')) {
            $customerVisitsData['customer_associate'] = request('customer_associate');
        }

        if($request->has('customer_associate_picture')) {
            $customerVisitsData['customer_associate_picture'] = request('customer_associate_picture');
        }

        // $customerVisits = CustomerVisits::create();

        dd($customerVisitsData);
    }

    /**
     * Determine if the users has the particular CustomerPackage
     */
    private function isCustomerOwnthePackagePlan(Customer $customer, Int $customerPackageId)
    {
        // ->contains($customerPackageId)
        $isAllowed = CustomerPackage::where('customer_id', $customer->customer_id)->pluck('customer_package_id')->contains($customerPackageId);

        if (! $isAllowed) {
            return $this->errorResponse('Customer is invalid for this action', 401);
        }
    }

}
