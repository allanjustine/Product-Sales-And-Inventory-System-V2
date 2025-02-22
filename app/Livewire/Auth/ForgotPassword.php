<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;
    public function resetLink()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $this->email)->first();

        if ($user) {
            $status = Password::sendResetLink([
                'email'         =>          $this->email
            ]);

            if ($status === Password::RESET_LINK_SENT) {
                $this->dispatch('alert', alerts: [
                    'type'          =>          "success",
                    'title'         =>          "Sent successfully.",
                    'message'       =>          "Password reset link has been sent to your email."
                ]);

                $this->reset('email');
                return $this->dispatch('closeModal');
            } elseif ($status === Password::INVALID_USER) {
                $this->dispatch('alert', alerts: [
                    'type'          =>          "info",
                    'title'         =>          "Not found.",
                    'message'       =>          "No user found with the provided email address."
                ]);
                return;
            } elseif ($status === Password::RESET_THROTTLED) {
                $this->dispatch('alert', alerts: [
                    'type'          =>          "warning",
                    'title'         =>          "Too many reset attempts.",
                    'message'       =>          "Too many reset attempts. Please try again later."
                ]);
                return;
            } else {
                $this->dispatch('alert', alerts: [
                    'type'          =>          "error",
                    'title'         =>          "Something went wrong.",
                    'message'       =>          "There was an error processing your request. Please try again later."
                ]);
                return;
            }
        } else {

            $this->dispatch('alert', alerts: [
                'type'          =>          "error",
                'title'         =>          "Error",
                'message'       =>          "We could not find a user with that email address."
            ]);
            return;
        }
    }
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
