<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BranchAddressUserForm extends Component
{
    public $regions;

    public $provinces;

    public $municipalities;

    public $barangay;

    public function mount()
    {
        $this->regions = DB::table('region')->get()->toArray();
        $this->provinces = DB::table('province')->get()->toArray();
        $this->municipalities = DB::table('municipality')->get()->toArray();
        $this->barangay = DB::table('barangay')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.branch-address-user-form');
    }
}
