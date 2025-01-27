<?php

namespace App\Livewire\Admin\Users;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['resetInputs'];

    use WithFileUploads;

    public $perPage = 5;
    public $name, $address, $email, $password, $password_confirmation, $gender, $phone_number, $remember_token, $profile_image;
    public $userEdit, $userRemove, $userView, $userToDelete, $roles, $role, $search;
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $profile_image_url;


    public function sortBy($field)
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

    public function addUser()
    {
        $this->validate([
            'name'              =>          'required|string|max:255',
            'address'           =>          'required|string|max:255',
            'email'             =>          'required|string|email|max:255|unique:users',
            'password'          =>          'required|string|min:4|confirmed',
            'gender'            =>          ['required', 'string', Rule::in('Male', 'Female')],
            'phone_number'      =>          'required|string|numeric|regex:/(0)[0-9]/|digits:11',
            'profile_image'     =>          'required|image|max:10000'
        ]);

        $token = Str::random(24);
        $path = $this->profile_image->store('public/profile/images');

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

        alert()->info('User Added', 'We sent an email to "' . $user->email . '" for verification.')->showConfirmButton('Okay');

        return redirect('/admin/users');
    }

    public function resetInputs()
    {
        $this->profile_image = '';
        $this->name = '';
        $this->address = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->gender = '';
        $this->phone_number = '';

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

    public function update()
    {
        $this->validate([
            'email'             =>      ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->userEdit->id],
            'profile_image'     =>      $this->profile_image ? ['image', 'max:10000'] : '',
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

        alert()->success('User Updated', 'The user is updated successfully');

        return redirect('/admin/users');

        $this->reset();
    }

    public function delete($id)
    {

        $this->userToDelete = User::find($id);

        if ($id === Auth::id()) {
            alert()->toast('Sorry, you cannot remove your own account', 'warning');
            return redirect('/admin/users');
        }
        $this->userRemove = $id;
    }

    public function deleteUser()
    {
        $user = User::where('id', $this->userRemove)->first();

        if ($user->profile_image && is_string($user->profile_image)) {
            Storage::delete($user->profile_image);
        }

        $user->delete();

        alert()->success('User Removed', 'The user "' . $user->name . '" has been removed successfully');

        return redirect('/admin/users');
    }

    public function view($id)
    {
        $this->userView = User::find($id);
    }

    public function updated($propertyData)
    {
        $this->validateOnly($propertyData, [
            'email'                 =>      ['required', 'email', 'unique:users,email,' . $this->id],
            'phone_number'          =>      ['required', 'numeric', 'digits:11', 'regex:/(0)[0-9]/'],
            'profile_image'         =>      'required|image|max:10000|mimes:jpeg,png,gif,webp,svg|not_in:ico'
        ]);
    }

    public function render()
    {

        $this->roles = Role::all();

        return view('livewire.admin.users.index', $this->loadUsers());
    }
}
