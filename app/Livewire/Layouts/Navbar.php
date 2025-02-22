<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
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
