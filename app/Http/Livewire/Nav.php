<?php

namespace App\Http\Livewire;

use App\Branch;
use App\Enums\BranchStatus;
use App\Enums\BranchType;
use Livewire\Component;

class Nav extends Component
{
    // Store the Current Logo.
    public $logo;

    // Store the CUrrent Home Url
    public $homeUrl;

    public $totalActiveBranchCount;

    public $totalActiveSalonBranchCount;

    public $totalActiveGymBranchCount;

    public $totalActiveSpaBranchCount;

    /**
     * Mounting component properties data.
     */
    public function mount()
    {
        $this->getTotalActiveBranchCount();
        $this->getTotalSalonBranchCount();
        $this->getTotalGymBranchCount();
        $this->getTotalSpaBranchCount();

        $this->logo = session('logo');
        $this->homeUrl = session('homeUrl');
    }

    /**
     * Hyrdating the Component.
     */
    public function hydrate()
    {
        $this->getTotalActiveBranchCount();
        $this->getTotalSalonBranchCount();
        $this->getTotalGymBranchCount();
        $this->getTotalSpaBranchCount();
    }


    /**
     * Returning the current active totalBranch.
     */
    private function getTotalActiveBranchCount()
    {
        $this->totalActiveBranchCount = Branch::where('branch_status', BranchStatus::ACTIVE)->count();
    }

    /**
     * Get the total (n) count of active Salon Branch.
     */
    private function getTotalSalonBranchCount()
    {
        $this->totalActiveSalonBranchCount = Branch::where('branch_type', BranchType::SALON)->where('branch_status', BranchStatus::ACTIVE)->count();
    }

    /**
     * Get the total (n) count of active Gym Branch.
     */
    private function getTotalGymBranchCount()
    {
        $this->totalActiveGymBranchCount = Branch::where('branch_type', BranchType::GYM)->where('branch_status', BranchStatus::ACTIVE)->count();
    }

    /**
     * Get the total (n) count of active Spa Branch.
     */
    private function getTotalSpaBranchCount()
    {
        $this->totalActiveSpaBranchCount = Branch::where('branch_type', BranchType::SPA)->where('branch_status', BranchStatus::ACTIVE)->count();
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.nav');
    }


}
