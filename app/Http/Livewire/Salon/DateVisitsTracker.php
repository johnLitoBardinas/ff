<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class DateVisitsTracker extends Component
{
    // Determine the Curre
    public $customerPackageVisits;

    // Customer Package Id
    public $customerPackageId;

    // Customer Package reference No.
    public $customerPackageReferenceNo;

    // CustomerMaximum Visits
    public $maxVisits;

    public function mount(
        Collection $customerPackageVisits,
        String $customerPackageReferenceNo,
        Int $customerPackageId
    )
    {
        $this->maxVisits = config('constant.package_visits_limit');

        $this->customerPackageVisits = $customerPackageVisits->toArray();

        $this->customerPackageReferenceNo = $customerPackageReferenceNo;

        // Hanging first?
        $this->customerPackageId = $customerPackageId;
    }

    public function render()
    {
        return view('livewire.salon.date-visits-tracker');
    }
}
