<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as ProviderUser;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function callbackFacebook()
    {
        try {
            $providerUser = Socialite::driver('facebook')->user();

            $user = User::firstOrCreate([
                'email' => $providerUser->getEmail(),
            ], [
                'name' => $providerUser->getName(),
            ]);

            auth()->login($user);
            return redirect()->to('/');
        } catch (\Exception $e) {
            Log::error('Error en la autenticación de Facebook: ' . $e->getMessage());
            return redirect()->route('login')->withErrors('No se pudo completar la autenticación con Facebook.');
        }
    }

    public function callbackGoogle()
    {
        try {
            $providerUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate([
                'email' => $providerUser->getEmail(),
            ], [
                'name' => $providerUser->getName(),
            ]);

            auth()->login($user);
            return redirect()->to('/');
        } catch (\Exception $e) {
            Log::error('Error en la autenticación de Google: ' . $e->getMessage());
            return redirect()->route('login')->withErrors('No se pudo completar la autenticación con Google.');
        }
    }
}
