<?php

namespace App\Http\Livewire\Management;

use App\Repositories\CustomerPackageRepository;
use Livewire\Component;

class ManagementTable extends Component
{
    // Listeners.
    protected $listeners = [ 'onSearchTable' ];

    // Store the Customer Package VIsits Table.
    public $customerPackageVisitsInfo;

    // current filter package status
    public $customerPackageStatus;

    // Package Type Salon, Gym, Spa.
    public $userBranchType;

    // Current User Info for Gym Visitation Logs
    public $currentUser;

    private function getManagementTableData()
    {
        $this->customerPackageVisitsInfo = CustomerPackageRepository::getAll();
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.management.management-table');
    }

    /**
     * Mounting the Component data.
     */
    public function mount()
    {
        $this->userBranchType = session('userAccessType');

        $this->customerPackageStatus = sprintf('%s_package_status', $this->userBranchType);

        $this->currentUser = auth()->user();

        $this->getManagementTableData();
    }

    /**
     * On search Table.
     * Reference No or Customer Name (Last Name/ First Name)
     */
    public function onSearchTable($search = '')
    {
        if (empty($search)) {
            $this->getManagementTableData();
            return;
        }

        $this->customerPackageVisitsInfo = CustomerPackageRepository::searchCustomerPackage($search);
    }
}
