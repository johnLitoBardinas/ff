<?php

namespace App\Http\Controllers\Api;

use App\Enums\BranchType;
use App\Http\Requests\Package as RequestsPackage;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showAll(Package::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsPackage $request)
    {
        $package = Package::create([
            'package_name' => $request->input('package_name'),
            'package_price' => $request->input('package_price'),
            'package_type' => $request->input('package_type'),
            'salon_no_of_visits' => $request->input('salon_no_of_visits'),
            'salon_days_valid_count' => $request->input('salon_days_valid_count'),
            'gym_no_of_visits' => $request->input('gym_no_of_visits'),
            'gym_days_valid_count' => $request->input('gym_days_valid_count'),
            'spa_no_of_visits' => $request->input('spa_no_of_visits'),
            'spa_days_valid_count' => $request->input('spa_days_valid_count'),
        ]);

        return $this->showOne($package, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return $this->showOne($package);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        if ($request->has('package_name')) {
            $package->package_name = $request->package_name;
        }

        if ($request->has('package_description')) {
            $package->package_description = $request->package_description;
        }

        if ($request->has('package_price')) {
            $package->package_price = $request->package_price;
        }

        if (!$package->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $package->save();

        return $this->showOne($package);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return $this->showOne($package);
    }

}
