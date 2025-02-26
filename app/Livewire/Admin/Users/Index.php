<?php

namespace App\Livewire\Admin\Users;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    use WithFileUploads;

    #[Title('Users')]

    public $perPage = 5;
    public $name, $address, $email, $password, $password_confirmation, $gender, $phone_number, $remember_token, $profile_image;
    public $userEdit;
    public $userView;
    public $userToDelete;
    public $roles;
    public $role;
    public $search;
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $profile_image_url;

    public function sortItemBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function loadUsers()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'user')
                ->orWhere('name', '=', 'admin');
        })
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->where('id', '!=', auth()->id())
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return compact('users');
    }

    #[On('verifyUser')]
    public function verifyUser($id) {
        $user = User::find($id);

        if(!$user) {
            $this->dispatch('alert', alerts: [
                'title'     =>      'Not Found',
                'message'   =>      'Sorry the user you\'re trying to verify does not exists.',
                'type'      =>      'error'
            ]);
            return;
        }

        if($user->email_verified_at !== null) {
            $this->dispatch('alert', alerts: [
                'title'     =>      'Ops.',
                'message'   =>      'Sorry the user you\'re trying to verify is already verified.',
                'type'      =>      'warning'
            ]);
            return;
        }

        $user->update([
            'email_verified_at'     =>      now()
        ]);

        $this->dispatch('alert', alerts: [
            'title'     =>      'Verified',
            'message'   =>      "{$user->name} is successfully verified.",
            'type'      =>      'success'
        ]);
        return;
    }

    public function addUser()
    {
        $this->validate([
            'name'              =>          'required|string|max:255',
            'address'           =>          'required|string|max:255',
            'email'             =>          'required|string|email|max:255|unique:users',
            'password'          =>          'required|string|min:4|confirmed',
            'gender'            =>          ['required', 'string', Rule::in('Male', 'Female')],
            'phone_number'      =>          'required|string|numeric|regex:/(0)[0-9]/|digits:11',
            'profile_image'     =>          'nullable|image|max:10000'
        ]);

        $token = Str::random(24);
        $path = $this->profile_image?->store('public/profile/images');

        $user = User::create([
            'name'              => $this->name,
            'address'           => $this->address,
            'email'             => $this->email,
            'password'          => Hash::make($this->password),
            'gender'            => $this->gender,
            'phone_number'      => $this->phone_number,
            'remember_token'    => $token,
            'profile_image'     => $path
        ]);

        $user->assignRole('user');

        Mail::send('pages.auth.verification-email', ['user' => $user, 'token' => $token], function ($mail) use ($user) {
            $mail->to($user->email);
            $mail->subject('Account verification');
        });

        $this->dispatch('alert', alerts: [
            'title'         =>          'User Added',
            'type'          =>          'success',
            'message'       =>          "We sent an email to \"{$user->email}\" for verification."
        ]);

        $this->dispatch('closeModal');

        return;
    }

    #[On('resetInputs')]
    public function resetInputs()
    {
        $this->profile_image = null;
        $this->name = '';
        $this->address = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->gender = '';
        $this->phone_number = '';
        $this->userView = null;
        $this->userEdit = null;
        $this->userToDelete = null;

        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->userEdit = User::find($id);

        $this->name = $this->userEdit->name;
        $this->address = $this->userEdit->address;
        $this->email = $this->userEdit->email;
        $this->password = $this->userEdit->password;
        $this->password_confirmation = $this->userEdit->password_confirmation;
        $this->gender = $this->userEdit->gender;
        $this->phone_number = $this->userEdit->phone_number;
        $this->role = $this->userEdit->roles->pluck('id')->toArray();

        if (is_string($this->userEdit->profile_image)) {
            $this->profile_image_url = Storage::url($this->userEdit->profile_image);
        } else if ($this->userEdit->profile_image !== null) {
            $this->profile_image = $this->userEdit->profile_image;
            $this->profile_image_url = $this->profile_image->temporaryUrl();
        }
    }

    public function updateUser()
    {
        $this->validate([
            'email'             =>      ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->userEdit->id],
            'profile_image'     =>      ['nullable', 'image', 'max:10000'],
            'phone_number'      =>      'required|string|numeric|regex:/(0)[0-9]/|digits:11',
            'gender'            =>      ['required', 'string', Rule::in('Male', 'Female')],
        ]);

        if ($this->profile_image && is_string($this->userEdit->profile_image)) {
            Storage::delete($this->userEdit->profile_image);
        }

        $this->userEdit->update([
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
            'profile_image' => $this->profile_image ? $this->profile_image->store('public/profile/images') : $this->userEdit->profile_image
        ]);

        $this->userEdit->syncRoles($this->role);

        $this->userEdit->save();

        $this->dispatch('alert', alerts: [
            'title'         =>          'User Updated',
            'type'          =>          'success',
            'message'       =>          "The user is updated successfully."
        ]);

        $this->dispatch('closeModal');

        return;
    }

    public function delete($id)
    {
        $this->userToDelete = User::find($id);

        if ($id === Auth::id()) {
            $this->dispatch('alert', alerts: [
                'title'         =>          'Ops.',
                'type'          =>          'warning',
                'message'       =>          "Sorry, you cannot remove your own account."
            ]);
            $this->dispatch("closeModal");
            return;
        }
    }

    public function deleteUser()
    {
        if ($this->userToDelete->profile_image && is_string($this->userToDelete->profile_image)) {
            Storage::delete($this->userToDelete->profile_image);
        }

        $this->userToDelete->delete();

        $this->dispatch('alert', alerts: [
            'title'         =>          'User Removed',
            'type'          =>          'success',
            'message'       =>          "The user \"{$this->userToDelete->name}\" has been removed successfully."
        ]);

        $this->dispatch('closeModal');


        $this->userView = null;
        $this->userEdit = null;
        $this->userToDelete = null;

        return;
    }

    public function view($id)
    {
        $this->userView = User::find($id);
    }

    public function removeImage()
    {
        $this->profile_image = null;
    }

    public function render()
    {

        $this->roles = Role::all();

        return view('livewire.admin.users.index', $this->loadUsers());
    }
}
