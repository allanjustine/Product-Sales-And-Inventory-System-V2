<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{

    use WithFileUploads;
    public $name, $address, $email, $password, $password_confirmation, $gender, $phone_number, $remember_token, $profile_image;

    public function register()
    {
        $validatedData = $this->validate([
            'name'              =>          'required|string|max:255',
            'address'           =>          'required|string|max:255',
            'email'             =>          'required|string|email|max:255|unique:users',
            'password'          =>          'required|string|min:4|confirmed',
            'gender'            =>          ['required', 'string', Rule::in('Male', 'Female')],
            'phone_number'      =>          'required|numeric|regex:/(0)[0-9]/|digits:11',
            'profile_image'     =>          'required|image|max:10000|mimes:jpeg,png,gif,webp,svg|not_in:ico'
        ]);

        $token = Str::random(24);
        $path = $this->profile_image->store('public/profile/images');

        $user = User::create([
            'name'              => $validatedData['name'],
            'address'           => $validatedData['address'],
            'email'             => $validatedData['email'],
            'password'          => Hash::make($validatedData['password']),
            'gender'            => $validatedData['gender'],
            'phone_number'      => $validatedData['phone_number'],
            'remember_token'    => $token,
            'profile_image'     => $path
        ]);

        $user->assignRole('user');

        Mail::send('pages.auth.verification-email', ['user' => $user, 'token' => $token], function ($mail) use ($user) {
            $mail->to($user->email);
            $mail->subject('Account verification');
        });

        alert()->info('Registered', 'We sent you a verification email. Please check your inbox for the verification.')->showConfirmButton('Okay');

        return redirect('/login');
    }
    public function updated($propertyData)
    {
        $this->validateOnly($propertyData, [
            'email'                 =>      ['required', 'email', 'unique:users'],
            'phone_number'          =>      ['required', 'numeric', 'regex:/(0)[0-9]/', 'digits:11'],
            'profile_image'         =>      'required|image|max:10000|mimes:jpeg,png,gif,webp,svg|not_in:ico'
        ]);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
