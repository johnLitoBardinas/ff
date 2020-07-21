<?php

namespace App\Http\Livewire;

use App\Branch;
use Livewire\Component;

class AdminBranches extends Component
{
    public function render()
    {
        $branches = Branch::all();
        return view('livewire.admin-branches')->with(compact('branches'));
    }
}
