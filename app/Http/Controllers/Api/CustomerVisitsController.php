<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerPackage;
use App\CustomerVisits;
use App\Enums\BranchType;
use App\Enums\CustomerPackageStatus;
use App\Enums\PackageType;
use App\Http\Requests\CustomerVisits as RequestsCustomerVisits;
use App\Repositories\CustomerVisitsRepository;
use App\Rules\IsBranchIdExist;
use Illuminate\Http\Request;
use App\Rules\IsCustomerHasPackage;
use App\Rules\IsCustomerPackageAvailableToVisit;
use App\Rules\IsUserIdExist;

class CustomerVisitsController extends ApiController
{
    protected $customerVisitsRepository;

    public function __construct(CustomerVisitsRepository $customerVisitsRepository)
    {
        $this->customerVisitsRepository = $customerVisitsRepository;
    }

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
    public function store(RequestsCustomerVisits $request, Customer $customer)
    {
        if (empty(request('customer_package_id'))) {
            return $this->errorResponse('Invalid Data', 422);
        }

        $customerPackageId = $request->customer_package_id;
        $customerPackageType = $request->package_type;

        $customerPackageLimit = $this->customerVisitsRepository->customerPackageVisitationLimit($customerPackageId, $customerPackageType);

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

        $customerVisits = CustomerVisits::create($customerVisitsData);

        $totalCustomerCurrentPackageVisitationCount = $this->customerVisitsRepository->getCustomerTotalCurrentPackageVisitation($customerPackageId, $customerPackageType);

        if ($totalCustomerCurrentPackageVisitationCount === (int) $customerPackageLimit) {
            $package_type_field = $request->package_type . '_package_status';
            CustomerPackage::where('customer_package_id', request('customer_package_id'))
                            ->update([$package_type_field => CustomerPackageStatus::COMPLETED]);
        }

        return $this->showOne($customerVisits, 201);
    }
}
