<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Enums\GymVisitationType;
use App\GymVisitation as AppGymVisitation;
use App\Http\Requests\GymVisitation;
use Carbon\Carbon;

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
        $visitationType = $request->input('visitation_type');

        $todayCustomerPackageGymVisitation = AppGymVisitation::where('customer_package_id', $request->customer_package_id)->whereDate('date', Carbon::today())->get()->last();

        // If it is none and the visitation_type === OUT then return false.
        if (empty($todayCustomerPackageGymVisitation->count()) && $visitationType === GymVisitationType::OUT) {
            return $this->errorResponse('Invalid Visitation Type', 422);
        }

        // If the visitaiton is equal to the current status of CustomerPackage Gym Visitation
        if ($visitationType === $todayCustomerPackageGymVisitation->visitation_type) {
            return $this->errorResponse("Customer Currently {$visitationType}", 422);
        }

        $gymVisitation = AppGymVisitation::create($request->all());

        return $this->showOne($gymVisitation);
    }
}
