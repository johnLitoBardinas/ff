<?php

namespace App\Http\Livewire\Admin;

use App\Role;
use App\Branch;
use App\Enums\AdminAction;
use Livewire\Component;

class BranchAddressUserForm extends Component
{
    protected $listeners = ['onChangeBranch' => 'setBranch'];

    // Current Branch Id.
    public $currentBranchId;

    // Current Branch.
    public $currentBranch;

    /**
     * Branch Name and Branch Address
     */
    public $branchName;
    public $branchAddress;
    public $branchStatus;
    public $branchUsers;

    // Current action into  the component.
    public $action;

    // List of Roles.
    public $roles;

    /**
     * Initial Mounting of data to the component.
     */
    public function mount()
    {
        $this->roles = Role::all()->toArray();

        $this->action = AdminAction::READ_BRANCH;

        $this->currentBranchId = Branch::orderBy('branch_id', 'DESC')->first()->branch_id;
        $this->setBranch();
    }

    /**
     * Getting the Branch ID.
     * Getting the first branch with users + region + province + municipality.
     * Supplied the necessary default RegionCode, ProviceCode, MunicipalityCode, BrgyCode.
     */
    public function setBranch($brandId = null)
    {
        $this->action = AdminAction::READ_BRANCH;

        if (! is_null($brandId)) {
            $this->currentBranchId = $brandId;
        }
        $this->setBranchUsingBranchId();
    }

    /**
     * Setting up the current branch information.
     */
    private function setBranchUsingBranchId()
    {
        $this->currentBranch = Branch::where('branch_id', $this->currentBranchId)->with('user.role')->get()->first();
        $this->branchName = $this->currentBranch->branch_name;
        $this->branchStatus = $this->currentBranch->branch_status;
        $this->branchAddress = $this->currentBranch->branch_address;
        $this->branchUsers = $this->currentBranch->user->toArray();
    }

    public function editBranch()
    {
        $this->action = AdminAction::EDIT_BRANCH;
    }

    public function exit()
    {
        $this->action = AdminAction::READ_BRANCH;
    }

    /**
     * Redering the component.
     */
    public function render()
    {
        return view('livewire.admin.branch-address-user-form');
    }

}
