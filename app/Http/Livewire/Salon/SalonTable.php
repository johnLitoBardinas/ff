<?php

namespace App\Http\Livewire\Salon;

use App\CustomerPackage;
use App\Enums\SalonAction;
use Livewire\Component;

class SalonTable extends Component
{
    protected $listeners = [
        'onClickNewOrActiveAccount',
        'onExpiredOrComplementedAccount',
        'OnNone',
        'onSearchSalonTable'
    ];

    // Displaying the current Table Data.
    public $currentDisplayType;

    // Store the Customer Package VIsits Table.
    public $customerPackageVisitsInfo;

    public $searchingText;

    /**
     * Mounting the Component data.
     */
    public function mount()
    {
        $this->OnNone();
        $this->getCustomerPackageData();
    }

    /**
     * On search Table.
     * Customer Name.
     */
    public function onSearchSalonTable(String $searchSalonTable = '')
    {
        if (empty( $searchSalonTable )) {
            $this->currentDisplayType = SalonAction::NONE;
            $this->customerPackageVisitsInfo = [];
        } else {
            $this->currentDisplayType = SalonAction::ALL;
            $this->getCustomerPackageData();

            $filtered = $this->customerPackageVisitsInfo->filter(function ($package) use ($searchSalonTable)
            {
                if (strpos(strtolower($package->customer->first_name), trim($searchSalonTable)) > -1) {
                    return true;
                } else if (strpos(strtolower($package->customer->last_name), trim($searchSalonTable)) > -1) {
                    return true;
                }

                return false;

            });

            $this->customerPackageVisitsInfo = $filtered;
        }

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
    public function OnNone()
    {
        $this->currentDisplayType = SalonAction::NONE;
        $this->getCustomerPackageData();
    }

    /**
     * Getting the CostumerPackageData.
     */
    private function getCustomerPackageData(String $filterType = 'all')
    {
        if ($this->currentDisplayType === SalonAction::NONE) {
            $this->customerPackageVisitsInfo = [];
            return;
        }

        $customerPackage = CustomerPackage::query();
        $customerPackage->orderBy('customer_package_start');

        if($filterType === 'notActive') {
            $customerPackage->where('customer_package_status', '!=', 'active');
        } else if ($filterType === 'active') {
            $customerPackage->where('customer_package_status', 'active');
        }

        $customerPackage->with('customer', 'package', 'customer_visits', 'branch', 'user');

        $this->customerPackageVisitsInfo = $customerPackage->get();
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.salon-table');
    }
}
