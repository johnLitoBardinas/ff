<?php

namespace App\Http\Livewire;

use App\Branch;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BranchAddressUserForm extends Component
{
    protected $listeners = [ 'currentBranch' => 'setBranch' ];

    public $regions;

    public $provinces;

    public $municipalities;

    public $barangay;

    public $currentBranch;

    public function mount()
    {
        $this->regions = DB::table('region')
                            ->get()
                            ->toArray();

        $this->provinces = DB::table('province')
                            ->get()
                            ->toArray();

        $this->municipalities = DB::table('municipality')
                            ->get()
                            ->toArray();

        $this->barangay = DB::table('barangay')
                            ->get()
                            ->toArray();

        $this->currentBranch = Branch::where('branch_id', 1)
                                ->with(['user.role', 'region', 'province', 'municipality', 'barangay'])
                                ->get()
                                ->toArray();
    }

    public function setBranch(Int $branchId)
    {
        $this->currentBranch = Branch::where('branch_id', $branchId)
            ->with(['user.role', 'region', 'province', 'municipality', 'barangay'])
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.branch-address-user-form');
    }
}
