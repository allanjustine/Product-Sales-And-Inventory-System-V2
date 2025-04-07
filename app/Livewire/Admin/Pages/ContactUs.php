<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Contact;
use Livewire\Attributes\On;
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

    #[On('publishCall')]
    public function handlePublish($id)
    {
        $feedback = Contact::find($id);

        if(!$feedback) {
            $this->dispatch('alert', alerts: [
                'type'          => 'error',
                'title'         => 'Error',
                'message'       => "Feedback with the id of {$id} does not exist"
            ]);
            return;
        }

        $feedback->update([
            'is_published'      => !$feedback->is_published
        ]);

        $status = $feedback->is_published ? 'published' : 'unpublished';

        $this->dispatch('alert', alerts: [
            'type'          => 'success',
            'title'         => 'Success',
            'message'       => "Feedback successfully {$status}"
        ]);
    }

    public function render()
    {
        return view('livewire.admin.pages.contact-us', $this->feedbacksLists());
    }
}
