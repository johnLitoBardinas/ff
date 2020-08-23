<?php

namespace App\Http\Livewire\Salon;

use App\Customer;
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

    /**
     * Mounting data to the component.
     */
    public function mount(String $encrypted_customer_id)
    {
        $this->getCustomerInfo(decrypt($encrypted_customer_id));

        $this->paymentsOptions = config('constant.payment_options');

        $this->getAllSubscriptionPlans();
    }

    /**
     * Getting all Subscription Plans.
     */
    private function getAllSubscriptionPlans()
    {
        $this->subscriptionPlans = Package::all()->toArray();
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
