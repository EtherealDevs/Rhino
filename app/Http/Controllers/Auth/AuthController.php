<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook(){
        $user = Socialite::driver('facebook')->user();

        $user = User::firstOrCreate([
            'name' => $user->getName(),
        ], [
            'email' => $user->getEmail(),
        ]);

        auth()->login($user);

        return redirect()->to('/');
    }

    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(){
        $user = Socialite::driver('google')->user();

        $user = User::firstOrCreate([
            'name' => $user->getName(),
        ], [
            'email' => $user->getEmail(),
        ]);

        auth()->login($user);

        return redirect()->to('/');
    }
}
