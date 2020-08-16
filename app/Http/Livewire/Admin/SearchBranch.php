<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class SearchBranch extends Component
{
    /**
     * Searching Branch text.
     */
    public $searchBranch;

    public function updatedSearchBranch()
    {
        $this->emitTo('admin.admin-branches', 'onSearchBranch', $this->searchBranch);
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.admin.search-branch');
    }
}
