<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class DateVisitsTracker extends Component
{
    // Determine the Curre
    public $customerPackageVisits;

    public $customerPackageId;

    public $maxVisits = 4;

    public function mount(Collection $customerPackageVisits)
    {
        $this->customerPackageVisits = $customerPackageVisits->toArray();
        $this->customerPackageId = $this->customerPackageVisits[0]['customer_package_id'];
    }

    public function render()
    {
        return view('livewire.salon.date-visits-tracker');
    }
}
