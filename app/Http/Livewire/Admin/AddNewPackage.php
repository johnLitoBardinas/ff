<?php

namespace App\Http\Livewire\Admin;

use App\Enums\BranchType;
use Livewire\Component;

class AddNewPackage extends Component
{
    public $salonType;

    public function mount(String $salon_type)
    {
        if ( ! in_array( $salon_type, BranchType::getValues() ) ) {
            return redirect()->route('packages');
        }

        $this->salonType = $salon_type;
    }

    public function render()
    {
        return view('livewire.admin.add-new-package');
    }
}
