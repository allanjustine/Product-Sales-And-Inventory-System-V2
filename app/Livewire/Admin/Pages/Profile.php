<?php

namespace App\Livewire\Admin\Pages;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    #[Title('Profile')]

    public $profile_image;
    public $user;
    public $name;
    public $gender;
    public $address;
    public $phone_number;
    public $email;
    public $oldPassword;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->gender = $this->user->gender;
        $this->address = $this->user->address;
        $this->phone_number = $this->user->phone_number;
        $this->email = $this->user->email;
    }

    public function show()
    {
        $user = Auth::user();

        return compact('user');
    }
    public function updatePhoto()
    {
        $this->validate([
            'profile_image' => 'image|max:10000',
        ]);

        if ($this->profile_image && is_string($this->user->profile_image)) {
            Storage::delete($this->user->profile_image);
        }

        $path = $this->profile_image->store('public/profile/images');
        $this->user->profile_image = $path;
        $this->user->save();

        $this->dispatch('alert', alerts: [
            'type'          =>          "success",
            'title'         =>          "Updated",
            'message'       =>          "Profile picture updated successfully"
        ]);

        $this->reset('profile_image');

        $this->dispatch('profileRefresh');

        return;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required',
            'gender' => ['required', 'string', Rule::in('Male', 'Female')],
            'address' => 'required',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
        ]);

        $this->user->name = $this->name;
        $this->user->gender = $this->gender;
        $this->user->address = $this->address;
        $this->user->phone_number = $this->phone_number;
        $this->user->email = $this->email;
        $this->user->save();

        $this->dispatch('alert', alerts: [
            'type'          =>          "success",
            'title'         =>          "Updated",
            'message'       =>          "Your profile is updated successfully"
        ]);

        return;
    }

    public function rules()
    {
        return [
            'oldPassword' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail('The old password is incorrect.');
                }
            }],
            'password' => [
                'required', 'string', 'min:4', 'confirmed',
                function ($attribute, $value, $fail) {
                    if ($value == $this->oldPassword) {
                        $fail('You cannot use your old password as your new password.');
                    }
                },
            ],
        ];
    }

    public function changePassword()
    {

        $this->validate();

        $this->user->password = bcrypt($this->password);
        $this->user->save();

        $this->dispatch('alert', alerts: [
            'type'          =>          "success",
            'title'         =>          "Updated",
            'message'       =>          "Your password has been changed successfully"
        ]);

        $this->reset(['oldPassword', 'password', 'password_confirmation']);

        return;
    }

    public function updated($propertyData)
    {
        $this->validateOnly($propertyData, [
            'profile_image'         =>      'required|image|max:10000|mimes:jpeg,png,gif,webp,svg|not_in:ico'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.pages.profile', $this->show());
    }
}
