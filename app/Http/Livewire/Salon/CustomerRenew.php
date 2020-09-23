<?php

namespace App\Http\Livewire\Salon;

use App\Customer;
use App\Enums\PackageStatus;
use App\Package;
use Livewire\Component;

class CustomerRenew extends Component
{
    // Customer Information.
    public $customerInfo;

    // List of Payment Options.
    public $paymentsOptions;

    // List of Packages or Subscription Plan.
    public $subscriptionPlans;

    // Type of the Package (Salon, Gym, Spa)
    public $currentCustomerPackageType;

    /**
     * Mounting data to the component.
     */
    public function mount(String $encrypted_customer_id)
    {
        $this->currentCustomerPackageType = session('userAccessType');

        $this->getCustomerInfo(decrypt($encrypted_customer_id));

        $this->paymentsOptions = config('constant.payment_options');

        $this->getAllSubscriptionPlans();
    }

    /**
     * Getting all Subscription Plans.
     */
    private function getAllSubscriptionPlans()
    {
        $this->subscriptionPlans = Package::where('package_status', PackageStatus::ACTIVE)->where('package_type', $this->currentCustomerPackageType)->get()->toArray();
    }

    /**
     * Customer Information.
     */
    private function getCustomerInfo(Int $customerId)
    {
        $this->customerInfo = Customer::where('customer_id', $customerId)->firstOrFail();
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.customer-renew');
    }
}
