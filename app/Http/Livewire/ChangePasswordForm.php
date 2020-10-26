<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePasswordForm extends Component
{
    // Hold the current password hashed format.
    public $currentUserPasswordHashed;

    // Verification for the old password.
    public $oldPassword;

    // New Desired Password.
    public $password;

    // Confirmation Password.
    public $password_confirmation;

    /**
     * Return the array of rules for change password validation.
     */
    private function changePasswordValidationRules()
    {
        return [
            'oldPassword' => [
                'required',
                fn ($attribute, $value, $fail) => ! Hash::check($value, $this->currentUserPasswordHashed) ? $fail('Incorrect Old Password') : true,
            ],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    /**
     * Rendering the component to the view.
     */
    public function render()
    {
        return view('livewire.change-password-form');
    }

    /**
     * Mounting the component and initializing properties.
     */
    public function mount()
    {
        $this->currentUserPasswordHashed = Auth::user()->password;
    }

    /**
     * Everytime the component properties change.
     */
    public function updated($field)
    {
        $this->validateOnly($field, $this->changePasswordValidationRules());
    }

    /**
     * Submisison of change password.
     */
    public function submitChangePassword()
    {
        $this->validate($this->changePasswordValidationRules());

        $userId = Auth::id();

        $user = User::find($userId);

        if (Hash::check($this->password, $user->password)) {
            session()->flash('error', 'New Password cannot be the Old Password!!!');
        } else {
            $user->password = Hash::make($this->password);
            $user->save();
            session()->flash('success', 'Password Changed!!!');
            $this->oldPassword = '';
            $this->password = '';
        }
    }
}
