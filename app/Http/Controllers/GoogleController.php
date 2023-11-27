<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use PHPUnit\Util\Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $finduser = User::where('google_id', $user->id)->first();

        if($finduser){

            Auth::login($finduser);
            return redirect('/');

        }else{
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id'=> $user->id,
            ]);

            Auth::login($newUser);
            return redirect('/');
        }
    }


}
