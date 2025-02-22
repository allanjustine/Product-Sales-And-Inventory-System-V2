<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

class ResetPassword extends Component
{

    public $email;
    public $token;
    public $password;
    public $password_confirmation;

    #[Title('Reset Password')]

    public function mount()
    {
        $this->token = request()->query('token');
        $this->email = request()->query('email');
    }

    public function resetPassword()
    {
        $this->validate([
            'password'          =>          ['required', 'min:6', 'confirmed'],
        ]);

        $status = Password::reset(
            [
                'email'                         =>                  $this->email,
                'password'                      =>                  $this->password,
                'password_confirmation'         =>                  $this->password_confirmation,
                'token'                         =>                  $this->token,
            ],
            function ($user) {
                $user->forceFill([
                    'password'                  =>              Hash::make($this->password),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            $this->dispatch('alert', alerts: [
                'type'          =>          "success",
                'title'         =>          "Success",
                'message'       =>          "Your password has been successfully reset! You can login now."
            ]);
            return $this->redirect("/login", navigate: true);
        } elseif ($status === Password::INVALID_TOKEN) {
            $this->dispatch('alert', alerts: [
                'type'          =>          "warning",
                'title'         =>          "Expired",
                'message'       =>          "The password reset token is invalid or has expired."
            ]);
            return;
        } elseif ($status === Password::INVALID_USER) {
            $this->dispatch('alert', alerts: [
                'type'          =>          "info",
                'title'         =>          "Not found",
                'message'       =>          "No user found with the provided email address."
            ]);
            return;
        } else {
            $this->dispatch('alert', alerts: [
                'type'          =>          "error",
                'title'         =>          "Something went wrong",
                'message'       =>          "An unexpected error occurred. Please try again."
            ]);
            return;
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
