<?php

namespace App\Http\Livewire\Salon;

use App\Customer;
use Livewire\Component;
use App\CustomerPackage;
use App\Enums\SalonAction;

class SalonTable extends Component
{
    // Listeners.
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

    // List of customer filters.
    public $customerListId;

    // Current Search String.
    public $searchingText;

    public $packageCustomerFilter;

    /**
     * Mounting the Component data.
     */
    public function mount()
    {
        $this->packageCustomerFilter = session('userAccessType') . '_package_status';
        $this->OnNone();
        $this->getCustomerPackageData();
    }

    /**
     * On search Table.
     * Customer Name.
     */
    public function onSearchSalonTable($searchSalonTable = null)
    {
        if (empty( $searchSalonTable )) {
            $this->OnNone();
        }

        $this->searchingText = $searchSalonTable;
        $this->customerListId = Customer::where('first_name', 'LIKE', '%' . trim($searchSalonTable) . '%')->orWhere('last_name', 'LIKE', '%' . trim($searchSalonTable) . '%')->pluck('customer_id')->toArray();

        if ( empty($this->customerListId) ) {
            $this->OnNone();
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
        $this->customerPackageVisitsInfo = [];

        if ($this->currentDisplayType === SalonAction::NONE) {
            $this->customerPackageVisitsInfo = [];
            return;
        }

        $customerPackage = CustomerPackage::query();
        $customerPackage->orderBy('customer_package_id');

        if($filterType === 'notActive') {
            $customerPackage->where($this->packageCustomerFilter, '!=', 'active');
        } else if ($filterType === 'active') {
            $customerPackage->where($this->packageCustomerFilter, 'active');
        }

        $customerPackage->with('customer', 'package', 'customer_visits', 'branch', 'user');

        $this->customerPackageVisitsInfo = $customerPackage->get()->filter(fn($customerPackage) => $customerPackage->branch->branch_type === session('userAccessType'))->values();

        dd($this->customerPackageVisitsInfo);
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.salon-table');
    }


}
