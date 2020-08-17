<?php

namespace App\Http\Livewire\Salon;

use App\Enums\SalonAction;
use Livewire\Component;

class SalonTable extends Component
{
    protected $listeners = [
        'onClickNewOrActiveAccount',
        'onExpiredOrComplementedAccount',
        'OnNone'
    ];

    // Displaying the current Table Data.
    public $currentDisplayType;

    // Store the Customer Package VIsits Table.
    public $customerPackageVisitsInfo;

    /**
     * Mounting the Component data.
     */
    public function mount()
    {
        $this->currentDisplayType = SalonAction::NONE;
    }

    /**
     * Displaying the Active or New Account.
     */
    public function onClickNewOrActiveAccount()
    {
       $this->currentDisplayType = SalonAction::NEW_ACTIVE_ACCOUNT;
    }

    /**
     * Displaying the Expired & Complement Account.
     */
    public function onExpiredOrComplementedAccount()
    {
        $this->currentDisplayType = SalonAction::EXPIRED_COMPLETED_ACCOUNT;
    }

    /**
     * On Reset of the Table.
     */
    public function OnNone()
    {
        $this->currentDisplayType = SalonAction::NONE;
    }
    /**
     * Rendering the component.
     */
    public function render()
    {
        return view('livewire.salon.salon-table');
    }
}
