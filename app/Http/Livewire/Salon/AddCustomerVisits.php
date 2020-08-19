<?php

namespace App\Http\Livewire\Salon;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddCustomerVisits extends Component
{
    public $encryptedCustomerPackageId;

    public function mount()
    {
        $this->encryptedCustomerPackageId = request('customer_package_id') ?? null;
    }

    public function render()
    {
        if ( empty($this->encryptedCustomerPackageId) ) {
            Auth::logout();
           return redirect('/');
        }

        return view('livewire.salon.add-customer-visits');
    }
}
