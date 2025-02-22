<?php

namespace App\Livewire\NormalView\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class About extends Component
{
    #[Title('About Us')]
    public function render()
    {
        return view('livewire.normal-view.pages.about');
    }
}
