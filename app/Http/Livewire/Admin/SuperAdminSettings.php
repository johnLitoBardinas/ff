<?php

namespace App\Http\Livewire\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SuperAdminSettings extends Component
{

    protected $listeners = [ 'onUpdateUserEmail' => '$refresh' ];

    public $users;

    public $superAdmin;

    public function mount()
    {
        // Users excluding superadmin
        $this->users = User::where('email', '!=', 'sadmin@ff.com')->get();

        $this->superAdmin = Auth::user()->email;
    }

    public function emailSave()
    {

    }

    public function render()
    {
        return view('livewire.admin.super-admin-settings');
    }
}
