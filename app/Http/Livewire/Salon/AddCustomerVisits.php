<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;
use App\CustomerPackage;
use App\CustomerVisits;

class AddCustomerVisits extends Component
{
    protected $listeners = [
        'onUpdateCustomerVisits' => 'getCustomerPackageVisitation'
    ];

    // Current Customer Package ID.
    public $customerPackageId;

    // Current Customer Package Type.
    public $customerPackageType;

    // Customer Package.
    public $customerPackageInfo;

    // Package End Date.
    public $customerPackageEndDate;

    // Total Visitation Count for the customerPackage.
    public $customerPackageVisitation;

    // Total Allocated Customer Visitation.
    public $customerPackageTotalVisitationCount = 0;

    /**
     * Mounting some default data.
     */
    public function mount()
    {
        $this->customerPackageId = decrypt(request('customer_package_id'));
        $this->customerPackageType = decrypt(request('package_type'));

        // Get the CustomerPackage, Customer, Package, Visits Info.
        $this->getCustomerPackageVisits();

        $this->getCustomerPackageEndDate();

        $this->getTotalPackageVisitation();

        $this->getCustomerPackageVisitation();

    }

        // Current Number of customer visitaion.
        public function getCustomerPackageVisitation()
        {
            $this->customerPackageVisitation = CustomerVisits::where('customer_package_id', $this->customerPackageId)->where('package_type', 'salon')->get()->toArray();
        }

    // Get the info for customerPackageVisits
    private function getCustomerPackageVisits()
    {
        $this->customerPackageInfo = CustomerPackage::where('customer_package_id', $this->customerPackageId)->with('customer', 'package', 'customer_visits')->first();
    }

    // Getting the current Package End Date.
    private function getCustomerPackageEndDate()
    {
        $package_type = $this->customerPackageType . '_package_end';
        $this->customerPackageEndDate = $this->customerPackageInfo->toArray()[$package_type];
    }

    // Total number of Visitation for the Package.
    private function getTotalPackageVisitation()
    {
        $package_type = $this->customerPackageType . '_no_of_visits';
        $this->customerPackageTotalVisitationCount = $this->customerPackageInfo->toArray()['package'][$package_type];
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.add-customer-visits');
    }
}
