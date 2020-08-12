<?php

namespace App\Http\Livewire\Salon;

use App\Package;
use Livewire\Component;
use stdClass;

class AddNewCustomer extends Component
{

    public $payments;

    public $subscriptionPlans;

    /**
     * Mounting data to the component.
     */
    public function mount()
    {
        $this->payments = config('constant.payment_options');
        $this->getAllSubscriptionPlans();
    }

    /**
     * Getting all Subscription Plans.
     */
    private function getAllSubscriptionPlans()
    {
        $this->subscriptionPlans = Package::all()->toArray();
    }

    public function render()
    {
        return view('livewire.salon.add-new-customer');
    }
}
