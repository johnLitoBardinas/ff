<?php

namespace App\Http\Livewire\Components;

use App\Role;
use App\User;
use Livewire\Component;

class BranchUsersForm extends Component
{

    // Current User (Optional)
    public $user;

    // Roles List.
    public $roles;

    public function mount($user = null)
    {
        if ( ! is_null($user) ) {
            $this->user = $user;
        }

        $this->roles = Role::all()->toArray();
    }

    public function render()
    {
        return view('livewire.components.branch-users-form');
    }
}
