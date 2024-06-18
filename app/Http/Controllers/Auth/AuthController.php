<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(){
        $user = Socialite::driver('facebook')->user();

        $user = User::firstOrCreate([
            'name' => $user->getName(),
        ], [
            'email' => $user->getEmail(),
        ]);

        auth()->login($user);

        return redirect()->to('/');
    }
}
