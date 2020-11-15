<?php

namespace App\Http\Livewire\Management;

use Livewire\Component;

class ManagementSearchField extends Component
{
    public $customerOrRefNumberField;

    public function searchField()
    {
        $this->emitTo('management.management-table', 'onSearchTable', $this->customerOrRefNumberField);
    }

    public function render()
    {
        return view('livewire.management.management-search-field');
    }
}
