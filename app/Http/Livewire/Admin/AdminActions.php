<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminActions extends Component
{
    public $currentAction;

    public $currentBranchId;

    public function mount(Int $currentBranchId)
    {
        $this->currentBranchId = $currentBranchId;
    }

    public function deleteBranch(Int $branchId)
    {
        # code...
    }

    public function deactivateBranch(Int $branchId)
    {
        # code...
    }

    public function saveBranch(Int $branchId)
    {
        # code...
    }

    public function addBranchUser(Int $branchId)
    {
        # code...
    }

    public function editBranch(Int $branchId)
    {
        # code...
    }

    public function render()
    {
        return view('livewire.admin.admin-actions');
    }
}
