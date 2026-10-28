<?php

namespace App\Livewire\Layouts;

use App\Models\Setting;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Footer extends Component
{
    #[Computed]
    public function setting()
    {
        return Setting::query()->first();
    }

    public function render()
    {
        return view('livewire.layouts.footer');
    }
}
