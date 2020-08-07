<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ModalUserForm extends Component
{
    public $roles;

    public $branchId;

    public $branchName;

    public function mount(Array $roles, Int $branchId, String $branchName)
    {
        $this->roles = $roles;
        $this->branchId = $branchId;
        $this->branchName = $branchName;
    }

    public function render()
    {
        return view('livewire.admin.modal-user-form');
    }
}
