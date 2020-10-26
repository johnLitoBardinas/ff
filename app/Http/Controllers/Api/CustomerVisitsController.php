<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerPackage;
use App\CustomerVisits;
use App\Enums\CustomerPackageStatus;
use App\Enums\PackageType;
use App\Rules\IsBranchIdExist;
use App\Rules\IsCustomerHasPackage;
use App\Rules\IsCustomerPackageAvailableToVisit;
use App\Rules\IsUserIdExist;
use Illuminate\Http\Request;

class CustomerVisitsController extends ApiController
{
    /**
     * Display a listing of the customer visits resource.
     */
    public function index(Customer $customer)
    {
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

        if (empty(request('customer_package_id'))) {
            return $this->errorResponse('Invalid Data', 422);
        }

        $customerPackageLimit = CustomerPackage::find($request->customer_package_id)->getCustomerPackageVisitationLimit($request->package_type);

        $rules = [
            'customer_package_id' => [
                'required',
                'integer',
                new IsCustomerHasPackage($customer->customer_id, $request->package_type),
                new IsCustomerPackageAvailableToVisit($customerPackageLimit),
            ],
            'branch_id' => [
                'required',
                'integer',
                new IsBranchIdExist(),
            ],
            'user_id' => [
                'required',
                'integer',
                new IsUserIdExist(),
            ],
            'package_type' => [
                'required',
                'string',
                'in:' . implode(',', PackageType::getValues()),
            ]
        ];

        $request->validate($rules);

        $customerVisitsData = [];

        $customerVisitsData['customer_package_id'] = request('customer_package_id');
        $customerVisitsData['branch_id'] = request('branch_id');
        $customerVisitsData['user_id'] = request('user_id');

        if ($request->has('date')) {
            $customerVisitsData['date'] = request('date');
        }

        if ($request->has('package_type')) {
            $customerVisitsData['package_type'] = request('package_type');
        }

        if ($request->has('customer_associate')) {
            $customerVisitsData['customer_associate'] = request('customer_associate');
        }

        if ($request->has('customer_associate_picture')) {
            $customerVisitsData['customer_associate_picture'] = request('customer_associate_picture');
        }

        $customerVisits = CustomerVisits::create($customerVisitsData);

        if ($customerVisits->getTotalCustomerVisits($request->package_type) === (int) $customerPackageLimit) {
            $package_type_field = $request->package_type . '_package_status';
            CustomerPackage::where('customer_package_id', request('customer_package_id'))
                ->update([$package_type_field => CustomerPackageStatus::COMPLETED]);
        }

        return $this->showOne($customerVisits, 201);
    }
}
