<?php

namespace App\Http\Livewire;

use App\Enums\BranchType;
use App\Repositories\BranchRepository;
use Livewire\Component;

class Nav extends Component
{
    // Store the Current Logo.
    public $logo;

    // Store the CUrrent Home Url.
    public $homeUrl;

    // Total Active branch counter.
    public $totalActiveBranchCount;

    // Total Salon Branch Counter.
    public $totalActiveSalonBranchCount;

    // Total Gym Branch Counter.
    public $totalActiveGymBranchCount;

    // Total Spa Branch Counter.
    public $totalActiveSpaBranchCount;

    // Current Management Branch.
    public $currentUserBranch;

    /**
     * Supplying branch information.
     */
    private function updateBranchInfo()
    {
        $this->totalActiveBranchCount = BranchRepository::getBranchCount();
        $this->totalActiveSalonBranchCount = BranchRepository::getBranchCount(BranchType::SALON);
        $this->totalActiveGymBranchCount = BranchRepository::getBranchCount(BranchType::GYM);
        $this->totalActiveSpaBranchCount = BranchRepository::getBranchCount(BranchType::SPA);
    }

    /**
     * Mounting component properties data.
     */
    public function mount()
    {
        $this->logo = session('logo');
        $this->homeUrl = session('homeUrl');

        if (! empty(session('userAccessType'))) {
            $this->currentUserBranch = auth()->user()->branchName();
        }

        $this->updateBranchInfo();
    }

    /**
     * Hyrdating the Component.
     */
    public function hydrate()
    {
        $this->updateBranchInfo();
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.nav');
    }
}
