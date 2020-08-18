<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class DateVisitsTracker extends Component
{
    // Determine the Curre
    public $customerPackageVisits;

    public $maxVisits = 4;

    public function mount(Collection $customerPackageVisits)
    {
        $this->customerPackageVisits = $customerPackageVisits->toArray();
    }

    public function render()
    {
        return view('livewire.salon.date-visits-tracker');
    }
}
