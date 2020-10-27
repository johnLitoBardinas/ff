<?php

namespace App\Http\Livewire\Salon;

use App\Repositories\PackageRepository;
use Livewire\Component;

class AddNewCustomer extends Component
{
    // List of Payment Options.
    public $paymentsOptions;

    // List of Packages or Subscription Plan.
    public $subscriptionPlans;

    // Determine the current customerPackageType.
    public $currentCustomerPackageType;

    /**
     * Mounting data to the component initial load.
     */
    public function mount()
    {
        $this->currentCustomerPackageType = session('userAccessType');

        $this->paymentsOptions = config('constant.payment_options');

        $this->subscriptionPlans = PackageRepository::getAllActive($this->currentCustomerPackageType)->toArray();
    }

    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.add-new-customer');
    }
}
