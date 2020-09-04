<?php

namespace App\Http\Livewire\Admin;

use App\Enums\BranchType;
use Livewire\Component;

class Packages extends Component
{
    public $activeTab;

    public function mount()
    {
        $this->activeTab = BranchType::SALON;
    }

    public function onClickTab(String $activeTab)
    {
        $this->activeTab = $activeTab;
    }

    public function render()
    {
        return view('livewire.admin.packages');
    }
}
