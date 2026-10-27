<?php

namespace App\Livewire\Admin\SetupWebsite;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    #[Title('Manage Website')]

    #[Validate(['sometimes', 'nullable', 'image', 'max:2048'])]
    public $uploaded_icon = null;

    public ?string $icon = null;

    #[Validate(['required', 'string', 'min:2'])]
    public ?string $name = null;

    #[Validate(['required', 'string', 'min:2'])]
    public ?string $description = null;

    #[Validate(['required', 'string', 'min:2'])]
    public ?string $address = null;

    #[Validate(['required', 'string', 'min:2', 'starts_with:<iframe', 'ends_with:</iframe>'])]
    public ?string $location_link = null;

    #[Validate(['required', 'digits:11'])]
    public ?string $phone = null;

    #[Validate(['required', 'email', 'min:2'])]
    public ?string $email = null;

    #[Validate(['required', 'before:opening_end', 'date_format:H:i'])]
    public ?string $opening_start = null;

    #[Validate(['required', 'after:opening_start', 'date_format:H:i'])]
    public ?string $opening_end = null;

    #[Validate([
        'links'   => ['array', 'min:1'],
        'links.*' => ['required', 'url']
    ])]
    public ?array $links = [];

    #[Computed]
    public function socialLinks()
    {
        return [
            'facebook',
            'twitter',
            'instagram',
            'tiktok'
        ];
    }

    public function handleSubmit()
    {
        $this->validate();

        $setting = Setting::firstOrNew();

        if ($setting->exists() && $this->uploaded_icon && Storage::disk('public')->exists($setting?->icon ?? "")) {
            Storage::disk('public')->delete($setting->icon ?? "");
        }

        $data = [
            'icon'          => $this->uploaded_icon ? $this->uploaded_icon->storeAs('settings', time() . "-" . $this->uploaded_icon->getClientOriginalName(), 'public') : $this->icon,
            'name'          => $this->name,
            'description'   => $this->description,
            'address'       => $this->address,
            'phone'         => $this->phone,
            'location_link' => $this->location_link,
            'opening_start' => $this->opening_start,
            'opening_end'   => $this->opening_end,
            'email'         => $this->email,
            'links'         => $this->links
        ];

        $setting->fill($data);

        $setting->save();

        $this->reset('uploaded_icon');

        $this->dispatch('submitted');

        $this->dispatch('alert', alerts: [
            'title'   => 'Updated Successfully',
            'type'    => 'success',
            'message' => 'Website details updated successfully'
        ]);
    }

    private function linkData()
    {
        return [
            'facebook'  => "https://facebook.com/",
            'twitter'   => "https://twitter.com/",
            'instagram' => "https://instagram.com/",
            'tiktok'    => "https://tiktok.com/"
        ];
    }

    #[On('submitted')]
    public function mount()
    {
        $setting = Setting::first();

        $this->icon          = $setting?->icon;
        $this->name          = $setting?->name;
        $this->description   = $setting?->description;
        $this->address       = $setting?->address;
        $this->phone         = $setting?->phone;
        $this->opening_start = $setting?->opening_start;
        $this->opening_end   = $setting?->opening_end;
        $this->location_link = $setting?->location_link;
        $this->email         = $setting?->email;
        $this->links         = $setting?->links ?? $this->linkData();
    }

    public function render()
    {
        return view('livewire.admin.setup-website.index');
    }
}
