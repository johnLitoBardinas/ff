<?php

namespace App\Http\Livewire\Management;

use App\Customer;
use App\CustomerPackage;
use App\Enums\ManagementAction;
use App\Repositories\CustomerPackageRepository;
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

    // Current Search String.
    public $searchingText;

    // Package Type Salon, Gym, Spa.
    public $packageType;

    // CurrentCustomerPackage Status  ['salon_package_status', 'gym_package_status', 'spa_package_status'].
    public $customerPackageStatus;

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

        $this->customerPackageVisitsInfo = CustomerPackageRepository::getAll($filterType, $this->packageType);
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
        $this->packageType = session('userAccessType');

        $this->customerPackageStatus = sprintf('%s_package_status', $this->packageType);

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
        }

        $this->searchingText = $customerName;
        $this->customerListId = Customer::where('first_name', 'LIKE', '%' . trim($customerName) . '%')->orWhere('last_name', 'LIKE', '%' . trim($customerName) . '%')->pluck('customer_id')->toArray();

        if (empty($this->customerListId)) {
            $this->onNone();
        }

        $this->customerPackageVisitsInfo = CustomerPackage::whereIn('customer_id', $this->customerListId)->with('customer', 'package', 'customer_visits', 'branch', 'user')->get();
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
