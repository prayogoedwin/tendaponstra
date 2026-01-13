<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function redirectToGoogle(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $userModel = User::updateOrCreate(
            ['google_id' => $user->id],
            [
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make($user->email),
                'google_token' => $user->token,
                'google_refresh_token' => $user->refreshToken,
            ]
        );
        Auth::login($userModel);
        return redirect()->route('dashboard')->with('success', 'Successfully logged in with Google.');
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            return redirect()->route('home')->with('success', 'Successfully logged out.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
