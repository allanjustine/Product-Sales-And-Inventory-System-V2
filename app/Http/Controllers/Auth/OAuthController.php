<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Socialite;

class OAuthController extends Controller
{
    public function oauthRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function oauthCallback($provider)
    {
        if (!request('code')) {
            return redirect('/login');
        }

        $oauthDetail = Socialite::driver($provider)->user();

        $user = User::query()->firstOrCreate([
            'email'             => $oauthDetail->getEmail(),
        ], [
            'name'              => $oauthDetail->getName(),
            'address'           => 'No Address Provided',
            'password'          => $oauthDetail->getId(),
            'email'             => $oauthDetail->getEmail(),
            'email_verified_at' => now(),
            'username'          => explode('@', $oauthDetail->getEmail())[0],
            'gender'            => 'Male',
            'phone_number'      => '00000000000'
        ]);

        if (!$user->profile_image) {
            $profile_url = $oauthDetail->getAvatar();

            $profile_picture = Http::get($profile_url)->body();

            $profile_name = time() . '-' . basename(parse_url($profile_url, PHP_URL_PATH)) . '.jpg';

            $path = "profile/images/{$profile_name}";

            Storage::disk('public')->put($path, $profile_picture);

            $user->update(['profile_image' => $path]);
        }

        $user->assignRole('user');

        Auth::login($user);

        session()->regenerate();

        return redirect('/');
    }
}
