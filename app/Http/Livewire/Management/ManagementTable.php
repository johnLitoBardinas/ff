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

        $this->customerPackageVisitsInfo = CustomerPackageRepository::getAll();
    }

    /**
     * On search Table.
     * Customer Name.
     */
    public function onSearchTable($customerName = null)
    {
        // if (empty($customerName)) {
        //     $this->onNone();
        //     return;
        // }

        // $possibleCustomersId = CustomerRepository::searchCustomerId($customerName);

        // if (empty($possibleCustomersId)) {
        //     $this->onNone();
        //     return;
        // }

        // $this->customerPackageVisitsInfo = CustomerPackage::whereIn('customer_id', $possibleCustomersId)->where('')->with('customer', 'package', 'customer_visits', 'branch', 'user')->get();
        // dd('All customer like the first name and lastname must be search using this functionality');
    }
}
