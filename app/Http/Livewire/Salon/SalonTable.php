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
        'OnNone'
    ];

    // Displaying the current Table Data.
    public $currentDisplayType;

    // Store the Customer Package VIsits Table.
    public $customerPackageVisitsInfo;

    /**
     * Mounting the Component data.
     */
    public function mount()
    {
        $this->OnNone();
        $this->getCustomerPackageData();
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
        // $this->currentDisplayType = SalonAction::EXPIRED_COMPLETED_ACCOUNT;
        $this->OnNone();
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
    private function getCustomerPackageData(String $filterType = 'active')
    {
        if ($this->currentDisplayType === SalonAction::NONE) {
            $this->customerPackageVisitsInfo = [];
            return;
        }

        $this->customerPackageVisitsInfo = CustomerPackage::orderBy('customer_package_start')
                                            ->where('customer_package_status', $filterType)
                                            ->with('customer', 'package', 'customer_visits', 'branch', 'user')
                                            ->get();
    }


    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.salon-table');
    }
}
