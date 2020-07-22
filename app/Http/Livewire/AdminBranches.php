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

    public function mount()
    {
        $this->branches = Branch::with('user.role')->get();
        $this->emit('currentBranch', $this->branches->first()->branch_id );
    }

    public function updatedBranches()
    {
        $this->branches = Branch::with('user.role')->get();
    }

    public function render()
    {
        return view('livewire.admin-branches');
    }

    public function toggleUserStatus(Int $userId)
    {
        $user = User::find($userId);
        $user->user_status = $user->user_status === UserStatus::ACTIVE ? UserStatus::INACTIVE : UserStatus::ACTIVE;
        $user->save();
    }
}
