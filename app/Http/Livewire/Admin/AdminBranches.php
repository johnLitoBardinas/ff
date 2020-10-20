<?php

namespace App\Http\Livewire\Admin;

use App\User;
use App\Branch;
use Livewire\Component;
use App\Enums\BranchType;
use App\Enums\UserStatus;
use App\Repositories\BranchRepository;

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
        $this->branches = BranchRepository::getAll();

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

        $this->branches = BranchRepository::getAll();
    }

    public function updatedCurrentBranchSearch()
    {
        if (empty($this->currentBranchSearch)) {
            $this->branches = BranchRepository::getAll();
            $this->activeBranchId = $this->branches->first()->branch_id;
        }
    }

    /**
     * Searchable Branch Name or Branch Address.
     */
    public function onSearchBranch(string $branch)
    {
        $this->currentBranchSearch = $branch;

        if (empty($this->currentBranchSearch)) {
            $this->branches = BranchRepository::getAll();
        } else {
            $this->branches = BranchRepository::searchBranch($branch);
        }
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
     * Rendering Component.
     */
    public function render()
    {
        return view('livewire.admin.admin-branches');
    }
}
