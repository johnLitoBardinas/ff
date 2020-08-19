<?php

namespace App\Http\Livewire\Salon;

use Livewire\Component;
use App\CustomerPackage;

class AddCustomerVisits extends Component
{
    public $referenceNo;

    public $customerPackageInfo;

    /**
     * Mounting some default data.
     */
    public function mount()
    {
        $this->referenceNo = request('reference_no');
        $this->getCustomerPackageVisits();
    }

    private function getCustomerPackageVisits()
    {
        $this->customerPackageInfo = CustomerPackage::where('reference_no', 'YRUEWYTU-4760')->with('customer', 'package', 'customer_visits')->first();
    }


    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.add-customer-visits');
    }
}
