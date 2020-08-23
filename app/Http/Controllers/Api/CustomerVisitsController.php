<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerPackage;
use App\CustomerVisits;
use App\Enums\CustomerPackageStatus;
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
        $customerVisits = Customer::where('customer_id', $customer->customer_id)
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

        if ( $this->getTotalCustomerVisits( request('customer_package_id') ) === (int) config('constant.package_visits_limit') ) {
            CustomerPackage::where('customer_package_id', request('customer_package_id'))
            ->update(['customer_package_status' => CustomerPackageStatus::COMPLETED]);
        }

        return $this->showOne($customerVisits, 201);

    }

    /**
     * Checking the customer Visitation.
     */
    private function getTotalCustomerVisits(Int $customerPackageId)
    {
        return CustomerVisits::where('customer_package_id', $customerPackageId)->count();
    }

}
