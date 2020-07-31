<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Enums\AdminAction;
use Illuminate\Http\Request;

class BranchController extends ApiController
{

    function __construct()  {
        $this->middleware('auth:sanctum');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $branchNameValidation = ['required'];
        $branchAddressValidation = ['required'];

        if (request('action') === AdminAction::ADD_BRANCH) {
            array_push($branchNameValidation, 'unique:branch,branch_name', 'max:50');
            array_push($branchAddressValidation, 'unique:branch,branch_address', 'max:191');
        } else {
            array_push($branchNameValidation, 'max:50');
            array_push($branchAddressValidation, 'max:191');
        }
        // Update the Branch Here
        $branchData = $request->validate([
            'branch_name' => $branchNameValidation,
            'branch_address' => $branchAddressValidation,
        ]);

        $isSave = Branch::where('branch_id', request('branch_id'))->update($branchData);
        dd($isSave);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
