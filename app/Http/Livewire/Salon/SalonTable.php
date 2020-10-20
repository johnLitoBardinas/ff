<?php

namespace App\Http\Livewire\Salon;

use App\Customer;
use Livewire\Component;
use App\CustomerPackage;
use App\Enums\SalonAction;
use App\Repositories\CustomerPackageRepository;

class SalonTable extends Component
{
    // Listeners.
    protected $listeners = [
        'onClickNewOrActiveAccount',
        'onExpiredOrComplementedAccount',
        'onNone',
        'onSearchSalonTable'
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

    public $customerPackageStatus;

    /**
     * Mounting the Component data.
     */
    public function mount()
    {
        $this->packageType = session('userAccessType');

        $this->customerPackageStatus = sprintf('%s_package_status', $this->packageType);

        $this->onNone();
        $this->getCustomerPackageData();
    }

    /**
     * On search Table.
     * Customer Name.
     */
    public function onSearchSalonTable($searchSalonTable = null)
    {
        if (empty($searchSalonTable)) {
            $this->onNone();
        }

        $this->searchingText = $searchSalonTable;
        $this->customerListId = Customer::where('first_name', 'LIKE', '%' . trim($searchSalonTable) . '%')->orWhere('last_name', 'LIKE', '%' . trim($searchSalonTable) . '%')->pluck('customer_id')->toArray();

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
        $this->currentDisplayType = SalonAction::NEW_ACTIVE_ACCOUNT;
        $this->getCustomerPackageData('active');
    }

    /**
     * Displaying the Expired & Complement Account.
     */
    public function onExpiredOrComplementedAccount()
    {
        $this->currentDisplayType = SalonAction::EXPIRED_COMPLETED_ACCOUNT;
        $this->getCustomerPackageData('notActive');
    }

    /**
     * On Reset of the Table.
     */
    public function onNone()
    {
        $this->currentDisplayType = SalonAction::NONE;
        $this->getCustomerPackageData();
    }

    /**
     * Getting the CostumerPackageData.
     */
    private function getCustomerPackageData(string $filterType = 'all')
    {
        $this->customerPackageVisitsInfo = [];

        if ($this->currentDisplayType === SalonAction::NONE) {
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
        return view('livewire.salon.salon-table');
    }
}
