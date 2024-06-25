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
        if(!isset($_GET['error'])){
        $user = Socialite::driver('facebook')->stateless()->user();

        $user = User::firstOrCreate([
            'email' => $user->getEmail(),
        ], [
            'name' => $user->getName(),
        ]);

        auth()->login($user);
        }
        return redirect()->to('/');
    }

    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(){
        if(!isset($_GET['error'])){
            $user = Socialite::driver('google')->stateless()->user();
            $user = User::firstOrCreate([
                'email' => $user->getEmail(),
            ], [
                'name' => $user->getName(),
            ]);
            auth()->login($user);
        }

        return redirect()->to('/');
    }
}
