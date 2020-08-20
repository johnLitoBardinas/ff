<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerVisits;
use App\Rules\IsBranchIdExist;
use Illuminate\Http\Request;
use App\Rules\IsCustomerHasPackage;
use App\Rules\IsCustomerPackageAvailableToVisit;
use App\Rules\IsUserIdExist;

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
        $customerVisits = Customer::where('customer_id', 1)
                            ->with('customer_packages.package', 'customer_packages.customer_visits')
                            ->get();

        return $this->showAll($customerVisits);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Customer $customer)
    {
        if( ! $request->has('customer_package_id') || empty( request('customer_package_id') ) ) {
            return $this->errorResponse('Invalid Data', 422);
        }

        /**
         * , new IsAvailableCustomerPackageToVisits() => Determining the current count of customer visits.
         * IsCustomerPackageAvailableToVisit
         */
        $rules = [
            'customer_package_id' => [
                'required',
                'integer',
                new IsCustomerHasPackage($customer->customer_id),
                new IsCustomerPackageAvailableToVisit()
            ],
            'branch_id' => [
                'required',
                'integer',
                new IsBranchIdExist()
            ],
            'user_id' => [
                'required',
                'integer',
                new IsUserIdExist()
            ],
        ];

        $request->validate($rules);

        $customerVisitsData = [];

        $customerVisitsData['customer_package_id'] = request('customer_package_id');
        $customerVisitsData['branch_id'] = request('branch_id');
        $customerVisitsData['user_id'] = request('user_id');

        if ($request->has('date')) {
            $customerVisitsData['date'] = request('date');
        }

        if ($request->has('customer_associate')) {
            $customerVisitsData['customer_associate'] = request('customer_associate');
        }

        if($request->has('customer_associate_picture')) {
            $customerVisitsData['customer_associate_picture'] = request('customer_associate_picture');
        }

        $customerVisits = CustomerVisits::create($customerVisitsData);
        return $this->showOne($customerVisits, 201);

    }

}
