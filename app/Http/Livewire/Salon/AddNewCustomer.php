<?php

namespace App\Http\Livewire\Salon;

use App\Package;
use Livewire\Component;
use App\Enums\PackageStatus;

class AddNewCustomer extends Component
{
    // List of Payment Options.
    public $paymentsOptions;

    // List of Packages or Subscription Plan.
    public $subscriptionPlans;

    // Determine the current customerPackageType.
    public $currentCustomerPackageType;

    /**
     * Mounting data to the component.
     */
    public function mount()
    {
        $this->currentCustomerPackageType = session('userAccessType');
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
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.add-new-customer');
    }


}
