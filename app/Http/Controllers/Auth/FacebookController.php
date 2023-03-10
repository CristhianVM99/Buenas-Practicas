<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function login()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $fb_user = Socialite::driver('facebook')->user();
        $user = User::where('external_id', $fb_user->id)
            ->where('auth_type', 'facebook')
            ->first();

        if(!$user) {
            $user = User::create([
                'name' => $fb_user->name,
                'email' => $fb_user->email,
                'external_id' => $fb_user->id,
                'auth_type' => 'facebook',
                'avatar' => $fb_user->avatar,
                'email_verified_at' => now()
            ]);
        }

        Auth::login($user);

        return redirect()->route('profile.edit');
    }
}
