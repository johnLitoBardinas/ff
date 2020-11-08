<?php

namespace App\Http\Livewire\Management;

use App\CustomerPackage;
use App\Enums\ManagementAction;
use App\Repositories\CustomerPackageRepository;
use App\Repositories\CustomerRepository;
use Livewire\Component;

class ManagementTable extends Component
{
    // Listeners.
    protected $listeners = [
        'onClickNewOrActiveAccount',
        'onExpiredOrComplementedAccount',
        'onNone',
        'onSearchTable',
    ];

    // Displaying the current Table Data.
    public $currentDisplayType;

    // Store the Customer Package VIsits Table.
    public $customerPackageVisitsInfo;

    // List of customer filters.
    public $customerListId;

    // Package Type Salon, Gym, Spa.
    public $currentPackageType;

    // CurrentCustomerPackage Status  ['salon_package_status', 'gym_package_status', 'spa_package_status'].
    public $customerPackageStatus;

    // Current User Info for Gym Visitation Logs
    public $currentUser;

    /**
     * Getting the CostumerPackageData.
     */
    private function getCustomerPackageData(string $filterType = 'all')
    {
        $this->customerPackageVisitsInfo = [];

        if ($this->currentDisplayType === ManagementAction::NONE) {
            $this->customerPackageVisitsInfo = [];
            return;
        }

        $this->customerPackageVisitsInfo = CustomerPackageRepository::getAll($filterType, $this->currentPackageType);
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
        $this->currentPackageType = session('userAccessType');

        $this->customerPackageStatus = sprintf('%s_package_status', $this->currentPackageType);

        $this->currentUser = auth()->user();

        $this->onNone();
    }

    /**
     * On search Table.
     * Customer Name.
     */
    public function onSearchTable($customerName = null)
    {
        if (empty($customerName)) {
            $this->onNone();
            return;
        }

        $possibleCustomersId = CustomerRepository::searchCustomerId($customerName);

        if (empty($possibleCustomersId)) {
            $this->onNone();
            return;
        }

        $this->customerPackageVisitsInfo = CustomerPackage::whereIn('customer_id', $possibleCustomersId)->where('')->with('customer', 'package', 'customer_visits', 'branch', 'user')->get();

    }

    /**
     * Displaying the Active or New Account.
     */
    public function onClickNewOrActiveAccount()
    {
        $this->currentDisplayType = ManagementAction::NEW_ACTIVE_ACCOUNT;
        $this->getCustomerPackageData('active');
    }

    /**
     * Displaying the Expired & Complement Account.
     */
    public function onExpiredOrComplementedAccount()
    {
        $this->currentDisplayType = ManagementAction::EXPIRED_COMPLETED_ACCOUNT;
        $this->getCustomerPackageData('notActive');
    }

    /**
     * On Reset of the Table.
     */
    public function onNone()
    {
        $this->currentDisplayType = ManagementAction::NONE;
        $this->getCustomerPackageData();
    }
}
