<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;

class SalonSearchField extends Component
{
    public $customerOrRefNumberField;

    public function submitSalonSearchField ()
    {
        $this->emitTo('salon.salon-table', 'onSearchSalonTable', $this->customerOrRefNumberField);
    }

    public function render()
    {
        return view('livewire.salon.salon-search-field');
    }
}
