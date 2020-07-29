<?php

namespace App\Http\Livewire\Admin;

use App\User;
use App\Branch;
use App\Enums\AdminAction;
use Livewire\Component;
use App\Enums\UserStatus;

class AdminBranches extends Component
{
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
        $this->branches = Branch::with('user.role')->get();
        $this->activeBranchId = $this->branches->first()->branch_id;
    }

    /**
     * Changing the active branch.
     */
    public function changeBranch(Int $id)
    {
        $this->activeBranchId = $id;
        $this->emit('onChangeBranch', $this->activeBranchId);
        $this->emit('Action', AdminAction::READ_BRANCH);
    }

    /**
     * Toggling User Status ('Active', 'Inactive').
     */
    public function toggleUserStatus(Int $userId)
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
