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
        $todayCustomerPackageGymVisitation = AppGymVisitation::where('customer_package_id', $request->customer_package_id)->with('branch', 'user')->whereDate('date', Carbon::today())->get()->last();

        if (is_null($todayCustomerPackageGymVisitation) && $request->input('visitation_type') === GymVisitationType::OUT) {
            return $this->errorResponse('Unable to Out the customer package', 422);
        }

        if (! is_null($todayCustomerPackageGymVisitation) && (int) $todayCustomerPackageGymVisitation->user_id !== (int) $request->input('user_id') && $todayCustomerPackageGymVisitation->visitation_type === GymVisitationType::IN) {
            $this->errorResponse("The customer package currently: ({$todayCustomerPackageGymVisitation->visitation_type}) branch: ({$todayCustomerPackageGymVisitation->branch->branch_name}) log by user: ({$todayCustomerPackageGymVisitation->user->first_name}, {$todayCustomerPackageGymVisitation->user->last_name})", 401);
        }

        if (! is_null($todayCustomerPackageGymVisitation) && $request->input('visitation_type') === $todayCustomerPackageGymVisitation->visitation_type) {
            return $this->errorResponse("Unable to {$todayCustomerPackageGymVisitation->visitation_type} the customer package", 422);
        }

        $gymVisitation = AppGymVisitation::create($request->all());
        return $this->showOne($gymVisitation, 201);
    }
}
