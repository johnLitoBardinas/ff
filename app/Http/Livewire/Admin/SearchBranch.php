<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class SearchBranch extends Component
{
    public $searchBranch;

    public function updatedSearchBranch()
    {
        $this->emitTo('admin.admin-branches', 'onSearchBranch', $this->searchBranch);
    }

    public function render()
    {
        return view('livewire.admin.search-branch');
    }
}
