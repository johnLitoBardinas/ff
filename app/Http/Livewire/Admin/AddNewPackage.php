<?php

namespace App\Http\Livewire\Admin;

use App\Enums\BranchType;
use Livewire\Component;

class AddNewPackage extends Component
{
    public $type;

    public $defaultPackageType;

    public function mount(string $type)
    {
        if (! in_array($type, BranchType::getValues())) {
            return redirect()->route('packages');
        }

        $this->type = $type;

        $this->defaultPackageType = config('constant.default_package_type');
    }

    public function render()
    {
        return view('livewire.admin.add-new-package');
    }
}
