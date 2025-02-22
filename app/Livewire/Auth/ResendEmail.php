<?php

namespace App\Livewire\Auth;

use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class ResendEmail extends Component
{
    public $email;

    public function resend()
    {
        $this->validate([
            'email' => ['required', 'email']
        ]);

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $this->dispatch('alert', alerts: [
                'type'          =>          "error",
                'title'         =>          "Email not found",
                'message'       =>          "Email not found. Please input valid email"
            ]);
            return;
        } elseif ($user->email_verified_at != null) {
            $this->dispatch('alert', alerts: [
                'type'          =>          "error",
                'title'         =>          "Already verified",
                'message'       =>          "This email is already verified. You can login now!"
            ]);
            return;
        } else {
            $token = Str::random(24);

            $user->update([
                'remember_token'    =>      $token
            ]);

            Mail::to($user->email)->send(new EmailVerification($user));

            $this->dispatch( 'alert', alerts: [
                'type'          =>          "info",
                'title'         =>          "Resend Email Verification",
                'message'       =>          "You request a resend email verification. Please check your inbox."
            ]);

            $this->dispatch('closeModal');

            $this->reset('email');
            return;
        }
    }

    public function render()
    {
        return view('livewire.auth.resend-email');
    }
}
