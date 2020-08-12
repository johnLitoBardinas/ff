<?php

namespace App\Http\Livewire\Salon;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AddNewCustomer extends Component
{

    public $payments;

    public function mount()
    {
        $this->payments = config('constant.payment_options');
    }

    public function render()
    {
        return view('livewire.salon.add-new-customer');
    }
}
