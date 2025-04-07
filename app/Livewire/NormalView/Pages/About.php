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
        $testimonies = Contact::query()
            ->where('is_published', true)
            ->get(['name', 'email', 'message', 'created_at']);

        return compact('testimonies');
    }

    public function render()
    {
        return view('livewire.normal-view.pages.about', $this->index());
    }
}
