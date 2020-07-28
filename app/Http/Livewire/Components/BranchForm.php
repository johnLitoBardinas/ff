<?php

namespace App\Http\Livewire\Components;

use App\Branch;
use Livewire\Component;

class BranchForm extends Component
{
    public $branch;

    public function mount($branch = null)
    {
        if (! is_null($branch)) {
            $this->branch = $branch;
        }
    }

    public function render()
    {
        return view('livewire.components.branch-form');
    }
}
