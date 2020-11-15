<?php

namespace App\Http\Livewire\Admin;

use App\Enums\BranchType;
use App\Enums\PackageStatus;
use App\Package;
use App\Repositories\PackageRepository;
use Livewire\Component;

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
        $this->packageList = PackageRepository::getAll($this->activeTab)->toArray();
    }

    /**
     * Switching the Tab.
     */
    public function onClickTab(string $activeTab)
    {
        $this->activeTab = $activeTab;
        $this->packageList = PackageRepository::getAll($this->activeTab)->toArray();
    }

    /**
     * Toggling Package Status.
     */
    public function togglePackageStatus(int $packageId)
    {
        $package = Package::find($packageId);

        $package->package_status = $package->package_status === PackageStatus::ACTIVE ? PackageStatus::INACTIVE : PackageStatus::ACTIVE;

        $package->save();

        $this->packageList = PackageRepository::getAll($this->activeTab)->toArray();
    }

    /**
     * Event Listener for deletion of specific Package.
     */
    public function onDeletePackage()
    {
        $this->packageList = PackageRepository::getAll($this->activeTab)->toArray();
    }

    public function render()
    {
        return view('livewire.admin.packages');
    }
}
