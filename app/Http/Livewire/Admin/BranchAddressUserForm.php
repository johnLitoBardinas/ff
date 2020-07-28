<?php

namespace App\Http\Livewire\Admin;

use App\Role;
use App\Branch;
use Livewire\Component;

class BranchAddressUserForm extends Component
{
    protected $listeners = ['onChangeBranch' => 'setBranch'];

    // Current Branch Id.
    public $currentBranchId;

    // Current Branch.
    public $currentBranch;

    /**
     * Initial Mounting of data to the component.
     */
    public function mount()
    {
        $this->currentBranchId = Branch::orderBy('branch_name')->first()->branch_id;
        $this->setBranch();
    }

    /**
     * Consecutive request from the component.
     */
    public function hydrate()
    {
        dd('Hydrate component here?');
    }

    /**
     * Getting the Branch ID.
     * Getting the first branch with users + region + province + municipality.
     * Supplied the necessary default RegionCode, ProviceCode, MunicipalityCode, BrgyCode.
     */
    public function setBranch($brandId = null)
    {
        if (! is_null($brandId)) {
            $this->currentBranchId = $brandId;
        }
        $this->setBranchUsingBranchId();
    }

    /**
     * Setting up the current branch information.
     */
    private function setBranchUsingBranchId()
    {
        $this->currentBranch = Branch::where('branch_id', $this->currentBranchId)->with('user.role')->get()->first()->toArray();
    }

    /**
     * Redering the component.
     */
    public function render()
    {
        return view('livewire.admin.branch-address-user-form');
    }

}
