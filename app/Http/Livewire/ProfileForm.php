<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfileForm extends Component
{
    public $currentUserId;

    public $firstName;

    public $lastName;

    public $mobileNumber;

    public function mount()
    {
        $this->currentUserId = Auth::id();
        $this->firstName = Auth::user()->first_name;
        $this->lastName = Auth::user()->last_name;
        $this->mobileNumber = Auth::user()->mobile_number;
    }

    public function profileSubmit()
    {
        $this->validate([
            'firstName' => 'required|string|max:191',
            'lastName' => 'required|string|max:191',
            'mobileNumber' => 'required|string|max:11',
        ]);
        $user = User::find($this->currentUserId);
        $user->first_name = $this->firstName;
        $user->last_name = $this->lastName;
        $user->mobile_number = $this->mobileNumber;
        $user->save();
        session()->flash('success', 'Profile updated!!!');
    }

    public function render()
    {
        return view('livewire.profile-form');
    }
}
