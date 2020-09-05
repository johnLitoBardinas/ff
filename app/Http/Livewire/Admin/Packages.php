<?php

namespace App\Http\Livewire\Admin;

use App\Package;
use Livewire\Component;
use App\Enums\BranchType;
use App\Enums\PackageStatus;

class Packages extends Component
{
    public $activeTab;

    public $packageList;

    public function mount()
    {
        $this->activeTab = BranchType::SALON;
        $this->getPackageList();
    }

    public function onClickTab(String $activeTab)
    {
        $this->activeTab = $activeTab;
        $this->getPackageList();
    }

    public function togglePackageStatus(Int $packageId)
    {
        $package = Package::find($packageId);
        $package->package_status = $package->package_status === PackageStatus::ACTIVE ? PackageStatus::INACTIVE : PackageStatus::ACTIVE;
        $package->save();
        $this->getPackageList();
    }

    public function render()
    {
        return view('livewire.admin.packages');
    }

    private function getPackageList()
    {
       $this->packageList = Package::orderBy('created_at', 'DESC')->where('package_type', $this->activeTab)->get()->toArray();
    }

}
