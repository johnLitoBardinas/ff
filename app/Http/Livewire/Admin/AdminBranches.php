<?php

namespace App\Http\Livewire\Admin;

use App\Branch;
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
        $this->emit('onChangeBranch', $this->activeBranchId);
    }

    /**
     * Rendering Component.
     */
    public function render()
    {
        return view('livewire.admin.admin-branches');
    }


}
