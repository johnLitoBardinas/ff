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

        $todayCustomerPackageGymVisitation = AppGymVisitation::where('customer_package_id', $request->customer_package_id)->with('branch', 'user')->whereDate('date', Carbon::today())->get()->last();

        if ($visitationType === GymVisitationType::IN && is_null($todayCustomerPackageGymVisitation)) {
            $gymVisitation = AppGymVisitation::create($request->all());
            return $this->showOne($gymVisitation, 201);
        } elseif( $visitationType === GymVisitationType::OUT && is_null($todayCustomerPackageGymVisitation)){
            return $this->errorResponse('Unable to Out the customer package', 422);
        } elseif ($visitationType !== $todayCustomerPackageGymVisitation->visitation_type) {
            $gymVisitation = AppGymVisitation::create($request->all());
            return $this->showOne($gymVisitation, 201);
        } else {
            return $this->errorResponse("The customer package currently: ({$visitationType}) branch: ({$todayCustomerPackageGymVisitation->branch->branch_name}) log by user: ({$todayCustomerPackageGymVisitation->user->first_name}, {$todayCustomerPackageGymVisitation->user->last_name})", 422);
        }
    }
}
