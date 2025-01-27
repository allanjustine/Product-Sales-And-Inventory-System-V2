<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            alert()->warning('Opsss', 'You are already login');
            return back();
        }
        return view('pages.auth.login');
    }

    public function logout()
    {
        auth()->logout();

        Alert::success('Logout', 'Logout successfully');

        return redirect('/login');
    }

    public function register()
    {
        if (auth()->check()) {
            alert()->warning('Opsss', 'Logout first before you register another account');

            return back();
        }
        return view('pages.auth.register');
    }

    public function verification($token, User $user)
    {

        if ($user->remember_token !== $token) {

            alert()->warning('Invalid token', 'The attached token is invalid or has already been consumed.');

            return redirect('/login');
        } else if ($user->email_verified_at !== null) {
            alert()->warning('Already verified', 'Your account has already been verified.');
            return redirect('/login');
        }

        $user->email_verified_at = now();

        $user->save();

        alert()->success('Congrats', 'Your account has been verified. You can login now.');

        return redirect('/login');
    }
}
