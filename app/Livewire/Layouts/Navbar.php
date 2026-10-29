<?php

namespace App\Livewire\Layouts;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\On;

class Navbar extends Component
{
    #[On('profileRefresh')]
    #[Computed]
    public function profilePicture()
    {
        return Auth::user()?->profile_image;
    }

    #[Computed]
    public function setting()
    {
        return Setting::query()->first();
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return $this->redirect('/login', navigate: true);
    }
    public function render()
    {
        return view('livewire.layouts.navbar');
    }
}
