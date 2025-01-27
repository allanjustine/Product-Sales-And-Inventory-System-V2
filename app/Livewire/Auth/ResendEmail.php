<?php

namespace App\Livewire\Auth;

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
            session()->flash('error', 'Email not found. Please input valid email');
        } elseif ($user->email_verified_at != null) {
            session()->flash('error', 'This email is already verified. You can login now!');
        } else {
            $token = Str::random(24);

            $user->update([
                'remember_token'    =>      $token
            ]);

            Mail::send('pages.auth.verification-email', ['user' => $user, 'token' => $token], function ($mail) use ($user) {
                $mail->to($user->email);
                $mail->subject('Account verification');
            });

            alert()->info('Resend Email Verification', 'You request a resend email verification. Please check your inbox.')->showConfirmButton('Okay');

            return redirect('/login');
        }
    }

    public function render()
    {
        return view('livewire.auth.resend-email');
    }
}
