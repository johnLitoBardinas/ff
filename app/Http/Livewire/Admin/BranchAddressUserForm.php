<?php

namespace App\Http\Livewire\Admin;

use App\Role;
use App\Branch;
use App\Enums\AdminAction;
use Livewire\Component;

class BranchAddressUserForm extends Component
{
    protected $listeners = ['onChangeBranch' => 'setBranch', 'Action' => 'action'];

    // determining the state for the component [addBranch, editBranch, deactivateBranch, addNewUser, deleteBranch]
    public $action;

    /**
     * Tracking the branch name and branch address.
     */
    public $newBranchName;
    public $newBranchAddress;
    public $newBranchUser = [];

    // Current Branch Id.
    public $currentBranchId;

    // Current Branch.
    public $currentBranch;

    /**
     * Existing Branch Name and Branch address.
     */
    public $branchName;
    public $branchAddress;

    // List of Roles.
    public $roles;

    /**
     * Initial Mounting of data to the component.
     */
    public function mount()
    {
        $this->roles = Role::all()->toArray();
        $this->currentBranchId = Branch::orderBy('branch_name')->first()->branch_id;
        $this->setBranch();
    }

    /**
     * Getting the Branch ID.
     * Getting the first branch with users + region + province + municipality.
     * Supplied the necessary default RegionCode, ProviceCode, MunicipalityCode, BrgyCode.
     */
    public function setBranch($brandId = null)
    {

        if (! is_null($brandId)) {
            $this->currentBranchId = $brandId;
        }

        $this->action = AdminAction::READ_BRANCH;

        $this->setBranchUsingBranchId();
    }

    /**
     * Setting up the current branch information.
     */
    private function setBranchUsingBranchId()
    {
        $this->currentBranch = Branch::where('branch_id', $this->currentBranchId)->with('user.role')->get()->first();
        $this->branchName = $this->currentBranch->branch_name;
        $this->branchAddress = $this->currentBranch->branch_address;
    }

    /**
     * Reset the Form for the Branch (Address + User)
     */
    public function action(String $actionType)
    {
        $this->action = $actionType;
    }

    /**
     * Redering the component.
     */
    public function render()
    {
        return view('livewire.admin.branch-address-user-form');
    }

}
