<?php

namespace App\Http\Livewire;

use App\Branch;
use Livewire\Component;

class AdminBranches extends Component
{
    public function render()
    {
        $branches = Branch::with('user.role')->get();
        // ddd($branches);
        return view('livewire.admin-branches')->with(compact('branches'));
    }
}
