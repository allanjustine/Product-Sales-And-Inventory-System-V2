<?php

namespace App\Livewire\NormalView\Pages;

use App\Models\Contact;
use Livewire\Attributes\Title;
use Livewire\Component;

class About extends Component
{
    #[Title('About Us')]

    public function index()
    {
        $testimonies = Contact::all();

        return compact('testimonies');
    }

    public function render()
    {
        return view('livewire.normal-view.pages.about', $this->index());
    }
}
