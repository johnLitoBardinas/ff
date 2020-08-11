<?php

namespace App\Http\Livewire\Salon;

use App\Enums\SalonAction;
use Livewire\Component;

class SalonActions extends Component
{
    public $action;

    public function mount()
    {
        $this->action = SalonAction::NONE;
    }

    public function render()
    {
        return view('livewire.salon.salon-actions');
    }
}
