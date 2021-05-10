<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerPackage;
use App\CustomerVisits;
use App\Enums\CustomerPackageStatus;
use App\Enums\PackageType;
use App\Repositories\CustomerPackageRepository;
use App\Rules\IsBranchIdExist;
use App\Rules\IsCustomerHasPackage;
use App\Rules\IsCustomerPackageAvailableToVisit;
use App\Rules\IsUserIdExist;
use Carbon\Carbon;
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

        $rules = [
            'customer_package_id' => [
                'required',
                'integer',
                new IsCustomerHasPackage($customer->customer_id),
                new IsCustomerPackageAvailableToVisit($request->package_type),
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
            ],
        ];

        $request->validate($rules);

        $customerVisitsData = [];

        $customerVisitsData['customer_package_id'] = request('customer_package_id');
        $customerVisitsData['branch_id'] = request('branch_id');
        $customerVisitsData['user_id'] = request('user_id');

        if ($request->has('date')) {
            $customerVisitsData['date'] = Carbon::parse(request('date'))->format('Y-m-d H:i:s');
        }

        if ($request->has('package_type')) {
            $customerVisitsData['package_type'] = request('package_type');
        }

        $customerVisits = CustomerVisits::create($customerVisitsData);

        $packageLimitVisits = CustomerPackageRepository::totalVisitation($request->customer_package_id, $request->package_type);

        $customerPackageVisits = CustomerPackageRepository::customerTotalVisits($request->customer_package_id, $request->package_type);

        if (count($customerPackageVisits) === (int) $packageLimitVisits) {
            $package_type_field = $request->package_type . '_package_status';
            CustomerPackage::where('customer_package_id', request('customer_package_id'))
                ->update([$package_type_field => CustomerPackageStatus::COMPLETED]);
        }

        $refNo = CustomerPackage::where('customer_package_id', request('customer_package_id'))->first()->reference_no ?? 0;
        // return $this->showOne($customerVisits, 201);

        return $this->showMessage(
            array_merge(
                $customerVisits->toArray(),
                [
                    'refno' => $refNo
                ]
            ),
            201
        );
    }
}
