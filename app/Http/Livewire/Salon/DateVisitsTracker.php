<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;

class DateVisitsTracker extends Component
{
    public $packageStatus;

    public function mount(String $packageStatus)
    {
        $this->packageStatus = $packageStatus ?: 'active';
    }

    public function render()
    {
        return view('livewire.salon.date-visits-tracker');
    }
}
