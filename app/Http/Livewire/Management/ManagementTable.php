<?php

namespace App\Http\Livewire\Management;

use App\CustomerPackage;
use App\Repositories\CustomerPackageRepository;
use App\Repositories\CustomerRepository;
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

        $possibleCustomersId = CustomerRepository::searchCustomerId($search);

        $this->customerPackageVisitsInfo = CustomerPackage::where('reference_no', 'LIKE', '%' . trim($search) . '%')->orWhere(function ($query) use ($possibleCustomersId) {
            return $query->whereIn('customer_id', $possibleCustomersId);
        })->with('customer', 'package', 'customer_visits', 'branch', 'user')->get();
    }
}
