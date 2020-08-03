<?php

namespace App\Http\Livewire\Admin;

use App\User;
use App\Branch;
use Livewire\Component;
use App\Enums\UserStatus;

class AdminBranches extends Component
{
    protected $listeners = ['onUpdateBranch'];
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
        $this->activeBranchId = $this->branches->first()->branch_id;
    }

    /**
     * Changing the active branch.
     */
    public function changeBranch(Int $branchId)
    {
        $this->activeBranchId = $branchId;
        $this->emit('onChangeBranch', $this->activeBranchId);
    }

    public function onUpdateBranch(Int $branchId = null)
    {
        if ( ! is_null( $branchId )) {
            $this->activeBranchId = $branchId;
        }

       $this->getAllBranches();

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

    protected function getAllBranches()
    {
        $this->branches = Branch::orderBy('branch_id', 'DESC')->with('user.role')->get();
    }

    /**
     * Rendering Component.
     */
    public function render()
    {
        return view('livewire.admin.admin-branches');
    }

}
