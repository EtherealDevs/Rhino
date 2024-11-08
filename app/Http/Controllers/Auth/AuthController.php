<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook()
    {
        // Obtener el usuario desde Facebook
        $facebookUser = Socialite::driver('facebook')->user();

        // Crear o encontrar al usuario en la base de datos
        $user = User::firstOrCreate(
            ['email' => $facebookUser->getEmail()],
            ['name' => $facebookUser->getName()]
        );

        // Iniciar sesión
        Auth::login($user);

        return redirect()->to('/');
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        // Obtener el usuario desde Google
        $googleUser = Socialite::driver('google')->user();

        // Crear o encontrar al usuario en la base de datos
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            ['name' => $googleUser->getName()],
            ['last_name' => $googleUser->getLastName]
            /* Entendes */
        );

        // Iniciar sesión
        Auth::login($user);

        return redirect()->to('/');
    }
}
