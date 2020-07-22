<?php

namespace App\Http\Livewire;

use App\Role;
use App\Branch;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BranchAddressUserForm extends Component
{
    protected $listeners = ['currentBranch' => 'setBranch'];

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

        $this->regions = DB::table('region')
            ->orderBy('region_name')
            ->get()
            ->toArray();

        $this->provinces = DB::table('province')
            ->orderBy('province_name')
            ->get()
            ->toArray();

        $this->municipalities = DB::table('municipality')
            ->orderBy('municipality_name')
            ->get()
            ->toArray();

        $this->barangay = DB::table('barangay')
            ->orderBy('barangay_name')
            ->get()
            ->toArray();

        $this->roles = Role::all()->toArray();
    }

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
