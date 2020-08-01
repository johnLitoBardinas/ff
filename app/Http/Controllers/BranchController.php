<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Enums\AdminAction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;

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
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {

        $request->validate([
            'branch_name' => ['required', 'string', 'max:50'],
            'branch_address' => ['required', 'string', 'max:190'],
        ]);

        $branch->branch_name = request('branch_name');
        $branch->branch_address = request('branch_address');

        // Checking if the branch data updated if not no point saving the new branch data.
        if ($branch->isDirty()) {
            $branch->save();
        }

        if ( ! empty( request('users') ) ) {
            $users = request('users');
            foreach ($users as $user) {
                User::updateOrCreate(
                    [ 'user_id' => $user['user_id'] ],
                    $user
                );
            }
        }

        $updatedBranch = Branch::where('branch_id', request('current_branch_id'))->with('user.role')->get();
        return response()->json($updatedBranch, 200);

    }

    public function updateBranchStatus(Branch $branch, String $status)
    {
        $branch->branch_status = $status;
        $branch->save();
        return response()->json($branch, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }

}
