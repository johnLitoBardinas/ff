<?php

namespace App\Http\Livewire;

use App\Branch;
use Livewire\Component;

class Nav extends Component
{
    public $logo;

    public $homeUrl;

    public $totalBranch;

    /**
     * Mounting component properties data.
     */
    public function mount()
    {
        $this->getTotalBranch();
        $this->logo = session('logo');
        $this->homeUrl = session('homeUrl');
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.nav');
    }

    /**
     * Returning the current totalBranch.
     */
    private function getTotalBranch()
    {
        $this->totalBranch = Branch::where('branch_status', 'active')->count();
    }

}
