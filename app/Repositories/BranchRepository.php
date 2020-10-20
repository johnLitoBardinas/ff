<?php

namespace App\Repositories;

use App\Branch;
use App\Enums\BranchType;

class BranchRepository
{

    /**
    * Getting all the branches excluding the hidden Admin Branch.
    */
    public static function getAll()
    {
        return Branch::orderBy('branch_id', 'DESC')->where('branch_type', '!=', BranchType::SUPER_ADMIN)->with('users.role')->get();
    }

    /**
     * Getting the first non super admin branch.
     */
    public static function getLastestBranch()
    {
        return Branch::orderBy('branch_id', 'DESC')->where('branch_type', '!=', BranchType::SUPER_ADMIN)->first();
    }

    /**
    * Searching a specific branch using Branch Code or Branch Name.
    */
    public static function searchBranch(string $search)
    {
        return Branch::where('branch_code', 'LIKE', '%' . $search . '%')->orWhere('branch_name', 'LIKE', '%' . $search . '%')->get();
    }

    /**
     * Getting Branch Information with users & roles information using Branch Id.
     */
    public static function getBranchInfoUsingId(int $branchId)
    {
        return Branch::where('branch_id', $branchId)->where('branch_type', '!=', BranchType::SUPER_ADMIN)->with('users.role')->first();
    }
}
