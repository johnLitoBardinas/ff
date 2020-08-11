<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;

class PackageStatusLabel extends Component
{
    public $type;

    public function mount(String $type)
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.salon.package-status-label');
    }
}
