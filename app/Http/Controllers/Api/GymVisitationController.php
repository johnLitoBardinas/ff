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

        if (is_null($todayCustomerPackageGymVisitation)) {
            if (request('visitation_type') === GymVisitationType::IN) {
                $gymVisitation = AppGymVisitation::create($request->all());
                return $this->showOne($gymVisitation, 201);
            }

            return $this->errorResponse('Today customer package is not yet visited.', 422);
        }

        if ($todayCustomerPackageGymVisitation->branch_id === (int) request('branch_id')) {
            if ($todayCustomerPackageGymVisitation->visitation_type !== request('visitation_type')) {
                $gymVisitation = AppGymVisitation::create($request->all());
                return $this->showOne($gymVisitation, 201);
            }

            return $this->errorResponse("Customer Gym Package already {$todayCustomerPackageGymVisitation->visitation_type}", 422);
        }

        if ($todayCustomerPackageGymVisitation->visitation_type === GymVisitationType::OUT && request('visitation_type') === GymVisitationType::IN) {
            $gymVisitation = AppGymVisitation::create($request->all());
            return $this->showOne($gymVisitation, 201);
        }

        return $this->errorResponse("The customer package currently: ({$todayCustomerPackageGymVisitation->visitation_type}) branch: ({$todayCustomerPackageGymVisitation->branch->branch_name}) log by user: ({$todayCustomerPackageGymVisitation->user->first_name}, {$todayCustomerPackageGymVisitation->user->last_name})", 401);
    }
}
