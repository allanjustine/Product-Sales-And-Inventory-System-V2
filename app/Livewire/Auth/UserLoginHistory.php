<?php

namespace App\Livewire\Auth;

use App\Models\UserLoginHistory as ModelsUserLoginHistory;
use Livewire\Component;

class UserLoginHistory extends Component
{
    public $histories = [];

    public function showLoginHistory()
    {
        $this->histories = ModelsUserLoginHistory::where('user_id', auth()->user()->id)->latest()->get();
    }

    public function render()
    {
        return view(
            'livewire.auth.user-login-history'
        );
    }
}
