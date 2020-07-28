<?php

namespace App\Http\Livewire\Admin;

use App\User;
use App\Branch;
use Livewire\Component;

class BranchCard extends Component
{
    public $branch;

    public $activeBranchId;

    public function mount(Branch $branch, Int $branchId)
    {
        $this->activeBranchId = $branchId;
        $this->branch = $branch;
    }

    /**
     * Toggling User Status ('Active', 'Inactive')
     */
    public function toggleUserStatus(Int $userId)
    {
        User::toggleUserStatus($userId);
    }

    public function render()
    {
        return view('livewire.admin.branch-card');
    }
}
