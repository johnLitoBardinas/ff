<?php

namespace App\Repositories;

use App\Branch;
use App\Enums\BranchStatus;
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

    /**
     * Getting the list of User Role
     *
     * @param String $packageType salon, gym, spa.
     *
     * @return Array|Collection|null
     */
    public static function getBranchCount(string $branchType = 'all')
    {
        $query = Branch::query();
        $query->where('branch_type', '!=', BranchType::SUPER_ADMIN);
        $query->where('branch_status', BranchStatus::ACTIVE);

        if ($branchType === BranchType::SALON)
        {
            $query->where('branch_type', BranchType::SALON);
        }
        elseif ($branchType === BranchType::GYM)
        {
            $query->where('branch_type', BranchType::GYM);
        }
        elseif ($branchType === BranchType::SPA)
        {
            $query->where('branch_type', BranchType::SPA);
        }

        return $query->count();
    }
}
