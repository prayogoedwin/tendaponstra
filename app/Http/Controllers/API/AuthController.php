<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')
                ->stateless()
                ->redirect();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        try {

            $userModel = User::updateOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->email),
                    'google_token' => $request->google_id
                    // 'google_token' => $googleUser->token,
                    // 'google_refresh_token' => $googleUser->refreshToken,
                ]
            );

            // Buat API token
            $token = $userModel->createToken('google-auth')->plainTextToken;

            return $this->ok(
                [
                    'token' => $token,
                    'user' => $userModel
                ],
                'Successfully logged in with Google.'
            );
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
