<?php

namespace App\Http\Livewire\Management;

use App\Repositories\CustomerPackageRepository;
use Livewire\Component;

class CustomersList extends Component
{
    public $refNoOrCustomerName;

    public $customers;

    public function mount()
    {
        $this->customers = [];
    }

    public function searchCustomer()
    {
        if (empty($this->refNoOrCustomerName)) {
            $this->customers = [];
            return;
        }

        $this->customers = CustomerPackageRepository::searchCustomerPackage($this->refNoOrCustomerName);
    }

    public function render()
    {
        return view('livewire.management.customers-list');
    }
}
