<?php

namespace App\Http\Livewire;

use App\Branch;
use App\Enums\UserStatus;
use App\User;
use Livewire\Component;

class AdminBranches extends Component
{
    public $branches;

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
        $this->emit('onChangeBranch', $id);
    }

    /**
     * Toggling User Status ('Active', 'Inactive')
     */
    public function toggleUserStatus(Int $userId)
    {
        $user = User::find($userId);
        $user->user_status = $user->user_status === UserStatus::ACTIVE ? UserStatus::INACTIVE : UserStatus::ACTIVE;
        $user->save();
    }

    public function render()
    {
        return view('livewire.admin-branches');
    }


}
