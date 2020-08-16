<?php

namespace App\Http\Controllers\Api;

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
    public function store(Request $request)
    {
        $data = $this->validatePackageDataRequest($request);
        $package = Package::create($data);
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
        $this->validatePackageDataRequest($request);

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

    private function validatePackageDataRequest(Request $request)
    {
        $data = $request->validate([
            'package_name' => ['required', 'unique:package,package_name', 'string'],
            'package_description' => ['required', 'string'],
            'package_price' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
        ]);

        return $data;
    }
}
