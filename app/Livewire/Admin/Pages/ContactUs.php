<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Contact;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ContactUs extends Component
{
    use WithPagination;
    #[Title('Feedbacks')]

    public function feedbacksLists()
    {
        $feedbacks = Contact::latest()->paginate(10);
        return compact('feedbacks');
    }
    public function render()
    {
        return view('livewire.admin.pages.contact-us', $this->feedbacksLists());
    }
}
