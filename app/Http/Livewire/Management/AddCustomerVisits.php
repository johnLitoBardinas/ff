<?php

namespace App\Http\Livewire\Management;

use App\Repositories\CustomerPackageRepository;
use Livewire\Component;

class AddCustomerVisits extends Component
{
    protected $listeners = [
        'onUpdateCustomerVisits' => 'getCustomerPackageVisitation',
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
    public $packageTotalCount = 0;

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.management.add-customer-visits');
    }

    /**
     * Mounting some default data.
     */
    public function mount()
    {
        $this->customerPackageId = decrypt(request('customer_package_id'));
        $this->customerPackageType = decrypt(request('package_type'));

        // Getting the customer Package Info
        $this->customerPackageInfo = CustomerPackageRepository::getOne($this->customerPackageId);

        // Getting the customer package type endDate.
        $this->customerPackageEndDate = CustomerPackageRepository::packageEndDate($this->customerPackageId, $this->customerPackageType);

        // Available Package Visitation by its type.
        $this->packageTotalCount = CustomerPackageRepository::totalVisitation($this->customerPackageId, $this->customerPackageType);

        // Customer Current Package Visitation.
        $this->customerPackageVisitation = CustomerPackageRepository::customerTotalVisits($this->customerPackageId, $this->customerPackageType);
    }

    public function getCustomerPackageVisitation(int $packageId = 0)
    {
        if (! empty($packageId)) {
            $this->customerPackageId = $packageId;
        }
        $this->customerPackageVisitation = CustomerPackageRepository::customerTotalVisits($this->customerPackageId, $this->customerPackageType);
    }
}
