<?php

namespace App\Http\Livewire\Admin;

use App\User;
use App\Branch;
use App\Enums\BranchType;
use Livewire\Component;
use App\Enums\UserStatus;

class AdminBranches extends Component
{
    protected $listeners = ['onUpdateBranch', 'onSearchBranch'];

    /**
     * Track the current branch name search.
     */
    public $currentBranchSearch;

    /**
     * List of all branches [active, inactive].
     */
    public $branches;

    /**
     * Track the current active Branch Id.
     */
    public $activeBranchId;

    /**
     * Mounting all branches.
     */
    public function mount()
    {
        $this->getAllBranches();
        if (! $this->branches->isEmpty()) {
            $this->activeBranchId = $this->branches->first()->branch_id;
        }
    }

    /**
     * Changing the active branch.
     */
    public function changeBranch(int $branchId)
    {
        $this->activeBranchId = $branchId;
        $this->emit('onChangeBranch', $this->activeBranchId);
    }

    /**
     * Updating the current branch card.
     */
    public function onUpdateBranch(?int $branchId)
    {
        if (! is_null($branchId)) {
            $this->activeBranchId = $branchId;
        }

        $this->getAllBranches();
    }

    public function updatedCurrentBranchSearch()
    {
        if (empty($this->currentBranchSearch)) {
            $this->getAllBranches();
            $this->activeBranchId = $this->branches->first()->branch_id;
        }
    }

    /**
     * Searchable Branch Name or Branch Address.
     */
    public function onSearchBranch(string $branch)
    {
        // Create a query for accessing the branch id or the branch name dynamically
        $this->currentBranchSearch = $branch;

        $this->branches = Branch::where('branch_code', 'LIKE', '%' . $branch . '%')
        ->orWhere('branch_name', 'LIKE', '%' . $branch . '%')->get();
    }

    /**
     * Toggling User Status ('Active', 'Inactive').
     */
    public function toggleUserStatus(int $userId)
    {
        $user = User::find($userId);
        $user->user_status = $user->user_status === UserStatus::ACTIVE ? UserStatus::INACTIVE : UserStatus::ACTIVE;
        $user->save();
    }

    /**
     * Getting all Branches.
     */
    protected function getAllBranches()
    {
        $this->branches = Branch::orderBy('branch_id', 'DESC')->where('branch_type', '!=', BranchType::SUPER_ADMIN)->with('users.role')->get();
    }

    /**
     * Rendering Component.
     */
    public function render()
    {
        return view('livewire.admin.admin-branches');
    }
}
