<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class Verification extends Component
{

    #[Title("Email Verification")]

    public function mount($token, User $user)
    {

        if ($user->remember_token !== $token) {

            session()->flash('invalidToken', [
                'type'          =>          "warning",
                'title'         =>          "Invalid token",
                'message'       =>          "The attached token is invalid or has already been consumed. This page will automatically close in 5 seconds."
            ]);

            return;
        }

        if ($user->email_verified_at !== null) {
            session()->flash('alreadyVerified', [
                'type'          =>          "warning",
                'title'         =>          "Already verified",
                'message'       =>          "Your account has already been verified. This page will automatically close in 5 seconds."
            ]);

            return;
        }

        $user->update([
            'email_verified_at'         =>      now()
        ]);

        session()->flash('verified',  [
            'type'          =>          "success",
            'title'         =>          "Congrats",
            'message'       =>          "Your account has been verified. You can login now. This page will automatically close in 5 seconds."
        ]);

        return;
    }

    public function render()
    {
        return view('livewire.auth.verification');
    }
}
