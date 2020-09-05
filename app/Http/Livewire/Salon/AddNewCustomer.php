<?php

namespace App\Http\Livewire\Salon;

use App\Enums\PackageStatus;
use App\Package;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AddNewCustomer extends Component
{
    // List of Payment Options.
    public $paymentsOptions;

    // List of Packages or Subscription Plan.
    public $subscriptionPlans;

    /**
     * Mounting data to the component.
     */
    public function mount()
    {
        $this->paymentsOptions = config('constant.payment_options');
        $this->getAllSubscriptionPlans();
    }

    /**
     * Getting all Subscription Plans.
     */
    private function getAllSubscriptionPlans()
    {
        $this->subscriptionPlans = Package::where('package_status', PackageStatus::ACTIVE)->get()->toArray();
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.add-new-customer');
    }
}
