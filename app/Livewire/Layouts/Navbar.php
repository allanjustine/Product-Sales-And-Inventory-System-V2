<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class Navbar extends Component
{
    public $profile_picture;
    
    #[On('profileRefresh')]
    public function profilePicture()
    {
        return $this->profile_picture = Auth::user()?->profile_image;
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
        return view('livewire.layouts.navbar', [
            $this->profilePicture()
        ]);
    }
}
