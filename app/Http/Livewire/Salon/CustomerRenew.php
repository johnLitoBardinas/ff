<?php

namespace App\Http\Livewire\Salon;

use App\Customer;
use App\Repositories\PackageRepository;
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
     * Customer Information.
     */
    private function getCustomerInfo(int $customerId)
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

    /**
     * Mounting data to the component.
     */
    public function mount(string $encrypted_customer_id)
    {
        $this->currentCustomerPackageType = session('userAccessType');

        $this->getCustomerInfo(decrypt($encrypted_customer_id));

        $this->paymentsOptions = config('constant.payment_options');

        $this->subscriptionPlans = PackageRepository::getAllActive($this->currentCustomerPackageType)->toArray();
    }
}
