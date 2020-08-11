<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;

class TableAction extends Component
{
    public $editRowIcon = 'svg/icons/table_edit.svg';
    public $type;

    public function mount(String $type)
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.salon.table-action');
    }
}
