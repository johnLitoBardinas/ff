<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;

class TableAction extends Component
{
    public $editRowIcon = 'svg/icons/table_edit.svg';
    public $type;

    public $customerId;

    /**
     * Mounting some Data.
     */
    public function mount(String $type, Int $customerId)
    {
        $this->type = $type;
        $this->customerId = $customerId;
    }

    /**
     * Redering component.
     */
    public function render()
    {
        return view('livewire.salon.table-action');
    }
}
