<?php

namespace App\Http\Livewire\Admin;

use App\Package;
use Livewire\Component;
use App\Enums\BranchType;
use App\Enums\PackageStatus;

class Packages extends Component
{
    // Event Listeners.
    protected $listeners = [ 'onDeletePackage' ];

    // Current Active Package Type.
    public $activeTab;

    // Package List.
    public $packageList;

    /**
     * Mounting some data.
     */
    public function mount()
    {
        $this->activeTab = BranchType::SALON;
        $this->getPackageList();
    }

    /**
     * Switching the Tab.
     */
    public function onClickTab(string $activeTab)
    {
        $this->activeTab = $activeTab;
        $this->getPackageList();
    }

    /**
     * Toggling Package Status.
     */
    public function togglePackageStatus(int $packageId)
    {
        $package = Package::find($packageId);
        $package->package_status = $package->package_status === PackageStatus::ACTIVE ? PackageStatus::INACTIVE : PackageStatus::ACTIVE;
        $package->save();
        $this->getPackageList();
    }

    /**
     * Event Listener for deletion of specific Package.
     */
    public function onDeletePackage()
    {
        $this->getPackageList();
    }

    public function render()
    {
        return view('livewire.admin.packages');
    }

    /**
     * Getting the Current Package.
     */
    private function getPackageList()
    {
        $this->packageList = Package::orderBy('created_at', 'DESC')->where('package_type', $this->activeTab)->get()->toArray();
    }
}
