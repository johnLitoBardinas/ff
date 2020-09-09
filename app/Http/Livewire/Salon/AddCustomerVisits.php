<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;
use App\CustomerPackage;
use Illuminate\Support\Facades\Auth;

class AddCustomerVisits extends Component
{
    protected $listeners = ['onUpdateCustomerVisits'];

    public $customerPackageId;

    // Customer Package
    public $customerPackageInfo;

    // Customer Visits
    public $customerPackageFirstVisit;
    public $customerPackageSecondVisit;
    public $customerPackageThirdVisit;
    public $customerPackageForthVisit;

    /**
     * Mounting some default data.
     */
    public function mount()
    {
        $this->customerPackageId = request('customer_package_id');
        $this->getCustomerPackageVisits();
    }

    private function getCustomerPackageVisits()
    {
        $this->customerPackageInfo = CustomerPackage::where('customer_package_id', decrypt($this->customerPackageId))->with('customer', 'package', 'customer_visits')->first();

        if (empty( $this->customerPackageInfo )) {
            Auth::logout();
            return redirect('/');
        }

        $this->setCustomerVisitationDate();

    }

    // On Update Customer Visits
    public function onUpdateCustomerVisits(Int $customerPackageId)
    {
        $this->customerPackageInfo = CustomerPackage::where('customer_package_id', $customerPackageId)->with('customer', 'package', 'customer_visits')->first();
        $this->setCustomerVisitationDate();
    }

    private function setCustomerVisitationDate()
    {
        $this->customerPackageFirstVisit = pikaday_date_format( $this->getCustomerVisitsDate(0) );
        $this->customerPackageSecondVisit = ! empty($this->getCustomerVisitsDate(1)) ? pikaday_date_format( $this->getCustomerVisitsDate(1) ) : 0;
        $this->customerPackageThirdVisit = ! empty($this->getCustomerVisitsDate(2)) ? pikaday_date_format( $this->getCustomerVisitsDate(2) ) : 0;
        $this->customerPackageForthVisit = ! empty($this->getCustomerVisitsDate(3)) ? pikaday_date_format( $this->getCustomerVisitsDate(3) ) : 0;
    }

    private function getCustomerVisitsDate(Int $index)
    {
        return $this->customerPackageInfo->customer_visits[$index]['date'] ?? null;
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.add-customer-visits');
    }
}
