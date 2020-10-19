<?php

namespace App\Http\Livewire\Admin;

use App\Repositories\UserRoleRepository;
use App\Branch;
use App\Enums\AdminAction;
use App\Enums\BranchType;
use Livewire\Component;

class BranchAddressUserForm extends Component
{
    protected $listeners = [
        'onChangeBranch' => 'updateCurrentBranch'
    ];

    // Current Branch Id.
    public int $currentBranchId;

    // Current Branch.
    public $currentBranch;

    /**
     * Branch Name and Branch Address
     */
    public string $branchName;
    public string $branchAddress;
    public string $branchStatus;
    public $branchUsers;

    // Current action into  the component.
    public string $action;

    // List of Roles.
    public string $roles;

    /**
     * Initial Mounting of data to the component.
     */
    public function mount()
    {
        $this->roles = UserRoleRepository::all('json');

        $this->action = AdminAction::READ_BRANCH;

        $this->currentBranchId = Branch::orderBy('branch_id', 'DESC')->where('branch_type', '!=', BranchType::SUPER_ADMIN)->first()->branch_id ?? 0;

        $this->getBranchInfoUsingId();
    }

    /**
     * Setting the Branch using a Optional Branch ID
     *
     * @param int $brandId
     */
    public function updateCurrentBranch(?int $branchId = null)
    {
        $this->action = AdminAction::READ_BRANCH;

        if (! is_null($branchId)) {
            $this->currentBranchId = $branchId;
        }

        $this->getBranchInfoUsingId();
    }

    /**
     * Setting up the current branch information.
     */
    private function getBranchInfoUsingId()
    {
        $this->currentBranch = Branch::where('branch_id', $this->currentBranchId)->where('branch_type', '!=', BranchType::SUPER_ADMIN)->with('users.role')->get()->first();

        $this->branchName = $this->currentBranch->branch_name ?? '';
        $this->branchStatus = $this->currentBranch->branch_status ?? '';
        $this->branchAddress = $this->currentBranch->branch_address ?? '';

        if (! empty($this->currentBranch->users)) {
            $this->branchUsers = $this->currentBranch->users->toJson() ?? json_encode([]);
        }
    }

    /**
     * Setting the current Admin Action to EditBranch
     */
    public function editBranch()
    {
        $this->action = AdminAction::EDIT_BRANCH;
    }

    /**
     * Setting the current Admin Action to ReadBranch
     */
    public function exit()
    {
        $this->action = AdminAction::READ_BRANCH;
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.admin.branch-address-user-form');
    }
}
