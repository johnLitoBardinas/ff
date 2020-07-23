<?php

namespace App\Http\Livewire;

use App\Barangay;
use App\Role;
use App\Branch;
use App\Municipality;
use App\Province;
use App\Region;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BranchAddressUserForm extends Component
{
    protected $listeners = ['onChangeBranch' => 'setBranch'];

    // Region List.
    public $regions;

    // Province List.
    public $provinces;

    // Municipality List.
    public $municipalities;

    // Barangay List.
    public $barangay;

    public $roles;

    // Current Branch.
    public $currentBranch;

    public function mount()
    {
        $this->currentBranch = Branch::where('branch_id', 1)
            ->with(['user.role', 'region', 'province', 'municipality', 'barangay'])
            ->get()
            ->first()
            ->toArray();

        $this->regions = Region::orderBy('region_name')->get()->toArray();
        $this->provinces = Province::orderBy('province_name')->get()->toArray();
        $this->municipalities = Municipality::orderBy('municipality_name')->get()->toArray();
        $this->barangay = Barangay::orderBy('barangay_name')->get()->toArray();
        $this->roles = Role::all()->toArray();
    }

    /**
     * Event Listener for Admin Branch Click.
     */
    public function setBranch(Int $branchId)
    {
        $this->currentBranch = Branch::where('branch_id', $branchId)
            ->with(['user.role', 'region', 'province', 'municipality', 'barangay'])
            ->get()
            ->first()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.branch-address-user-form');
    }
}
