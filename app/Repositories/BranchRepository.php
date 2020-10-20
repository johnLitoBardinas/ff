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
    * Searching a specific branch using Branch Code or Branch Name.
    */
    public static function searchBranch(string $search)
    {
        return Branch::where('branch_code', 'LIKE', '%' . $search . '%')->orWhere('branch_name', 'LIKE', '%' . $search . '%')->get();
    }
}
