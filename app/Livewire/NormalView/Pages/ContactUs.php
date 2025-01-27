<?php

namespace App\Livewire\NormalView\Pages;

use App\Models\Contact;
use Livewire\Component;

class ContactUs extends Component
{

    public $user;
    public $name;
    public $email;
    public $message;

    public function submit()
    {
        $this->validate([
            'name'          =>          ['required', 'string', 'max:255'],
            'email'         =>          ['required', 'email', 'max:255'],
            'message'       =>          ['required', 'string', 'max:65535']
        ]);

        $contact = Contact::create([
            'name'          =>          $this->name,
            'email'         =>          $this->email,
            'message'       =>          $this->message
        ]);

        $contact->save();

        alert()->success('Submitted', 'Thank you for submitting feedbacks we appreciated it. Have a nice day.');

        return redirect('/contact-us');
    }

    public function mount()
    {
        if (auth()->check()) {
            $this->user = auth()->user();
            $this->name = $this->user->name;
            $this->email = $this->user->email;
        }
    }

    public function displayFeedBacks()
    {
        $feedbacks = Contact::orderBy('created_at', 'desc')->get();

        return compact('feedbacks');
    }

    public function render()
    {
        return view('livewire.normal-view.pages.contact-us', $this->displayFeedBacks());
    }
}
