<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Contact;
use Livewire\Component;

class ContactUs extends Component
{

    public $feedbacks;

    public function mount()
    {
        $this->feedbacks = Contact::latest()->get();
    }
    public function render()
    {
        return view('livewire.admin.pages.contact-us');
    }
}
