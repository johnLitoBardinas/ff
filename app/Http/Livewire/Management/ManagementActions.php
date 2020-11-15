<?php

namespace App\Http\Livewire\Management;

use App\Enums\ManagementAction;
use Livewire\Component;

class ManagementActions extends Component
{
    public $action;

    public function mount()
    {
        $this->action = ManagementAction::NONE;
    }

    public function render()
    {
        return view('livewire.management.management-actions');
    }
}
