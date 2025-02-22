<?php

namespace App\Livewire\Auth;

use App\Mail\EmailVerification;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{
    #[Title("Register")]
    public $name, $address, $email, $password, $password_confirmation, $gender, $phone_number, $remember_token, $profile_image;

    use WithFileUploads;

    public function mount()
    {
        if (auth()->check()) {
            session()->flash('already_login', [
                'title' => 'Ops!',
                'type' => 'warning',
                'message' => 'You are already login'
            ]);
            return $this->redirect('/', navigate: true);
        }
    }

    public function register()
    {
        $validatedData = $this->validate([
            'name'              =>          'required|string|max:255',
            'address'           =>          'required|string|max:255',
            'email'             =>          'required|string|email|max:255|unique:users',
            'password'          =>          'required|string|min:4|confirmed',
            'gender'            =>          ['required', 'string', Rule::in('Male', 'Female')],
            'phone_number'      =>          'required|numeric|regex:/(0)[0-9]/|digits:11',
            'profile_image'     =>          'required|mimes:jpeg,jpg,png,gif,ico|max:1020'
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

        // Mail::send(view: 'livewire.auth.verification-email', ['user' => $user, 'token' => $token], function ($mail) use ($user) {
        //     $mail->to($user->email);
        //     $mail->subject('Account verification');
        // });

        Mail::to($user->email)->send(new EmailVerification($user));

        alert()->info('Registered', 'We sent you a verification email. Please check your inbox for the verification.')->showConfirmButton('Okay');

        return $this->redirect('/login', navigate: true);
    }

    public function removeProfileImage() {
        $this->profile_image = null;
    }

    public function updated($propertyData)
    {
        $this->validateOnly($propertyData, [
            'email'                 =>      ['required', 'email', 'unique:users'],
            'phone_number'          =>      ['required', 'numeric', 'regex:/(0)[0-9]/', 'digits:11'],
            'profile_image'         =>      'required|mimes:jpeg,jpg,png,gif,ico|max:1020'
        ]);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
