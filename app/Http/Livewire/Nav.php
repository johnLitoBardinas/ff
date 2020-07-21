<?php

namespace App\Http\Livewire;

use App\Branch;
use Livewire\Component;

class Nav extends Component
{
    public $logo;

    public $totalBranch;

    public function mount(String $logo)
    {
        $this->logo = $logo;
        $this->totalBranch = Branch::where('branch_status', 'active')->count();
    }

    public function render()
    {
        return view('livewire.nav');
    }
}
