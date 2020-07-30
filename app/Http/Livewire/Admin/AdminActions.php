<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Enums\AdminAction;

class AdminActions extends Component
{
    protected $listeners = ['Action' => 'action'];

    public $action;

    public $currentBranchId;

    public function mount()
    {
        $this->action = AdminAction::READ_BRANCH;
    }

    public function action(String $actionType)
    {
        $this->action = $actionType;
    }

    public function deleteBranch(Int $branchId)
    {
        # code...
    }

    public function deactivateBranch(Int $branchId)
    {
        # code...
    }

    public function saveBranch()
    {
        $this->emitUp('Action', 'saveBranch');
    }

    public function addBranchUser()
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
