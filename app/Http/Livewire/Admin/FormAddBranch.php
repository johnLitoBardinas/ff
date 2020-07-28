<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class FormAddBranch extends Component
{
    // Store the current branch address.
    public $branchAddress;

    // List of users on the branch.
    public $branchUsers = [];

    public function render()
    {
        return view('livewire.admin.form-add-branch');
    }
}
