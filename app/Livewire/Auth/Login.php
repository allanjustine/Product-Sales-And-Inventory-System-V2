<?php

namespace App\Livewire\Auth;

use App\Events\UserLoginHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Jenssegers\Agent\Agent;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    #[Title("Login")]

    public $username_or_email;
    public $password;
    public $remember = false;
    public $user;

    public function mount()
    {
        $this->username_or_email = $this->username_or_email ?: Cookie::get('remembered_username_or_email');
        $this->remember = Cookie::has('remembered_username_or_email');

        if (auth()->check()) {
            session()->flash('already_login', [
                'title' => 'Ops!',
                'type' => 'warning',
                'message' => 'You are already login'
            ]);
            return $this->redirect('/', navigate: true);
        }
    }

    public function login()
    {
        $this->validate([
            'username_or_email'             =>      'required',
            'password'                      =>      'required',
        ]);


        if ($this->remember) {
            Cookie::queue('remembered_username_or_email', $this->username_or_email, 60 * 24 * 30); // 30 days
        } else {
            Cookie::queue(Cookie::forget('remembered_username_or_email'));
        }

        $user = User::where('email', $this->username_or_email)->orWhere('username', $this->username_or_email)->first();

        if (!$user || $user->email_verified_at == null) {

            $this->dispatch('alert', alerts: [
                'type'          =>          "error",
                'title'         =>          "Something went wrong",
                'message'       =>          "The email is either not verified yet or does not exist"
            ]);
            return;
        }

        if (Auth::attempt([
            'email'         =>          filter_var($this->username_or_email, FILTER_VALIDATE_EMAIL) ? $this->username_or_email : $user->email,
            'password'      =>          $this->password
        ])) {

            $agent = new Agent();

            $ip_address = request()->ip() ?? 'Unknown IP';

            $browser_address = $agent->platform() . ", " .  $agent->browser() ?? 'Unknown Browser';

            session()->regenerate();

            if (auth()->user()->is_admin) {

                event(new UserLoginHistory($ip_address, $browser_address));

                return $this->redirect('/admin/dashboard', navigate: true);
            } else {

                event(new UserLoginHistory($ip_address, $browser_address));

                return $this->redirect('/', navigate: true);
            }
        } else {

            $this->dispatch('alert', alerts: [
                'type'          =>          "warning",
                'title'         =>          "Sorry",
                'message'       =>          "Invalid Credentials"
            ]);
            return;
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
