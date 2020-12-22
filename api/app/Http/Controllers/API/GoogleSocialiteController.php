<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Socialite;

class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
       
    public function handleCallback()
    {
        $user = Socialite::driver('google')->user();
    
        $findUser = User::where('social_id', $user->id)->first();
    
        if($finduser){
            $accessToken = $findUser->createToken('authToken')->accessToken;
            
            return response([ 'user' => $findUser, 'access_token' => $accessToken]);
        }else{
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_id'=> $user->id,
                'social_type'=> 'google',
                // FIXME: this should be a random string
                'password' => bcrypt('my-google')
            ]);
    
            $accessToken = $newUser->createToken('authToken')->accessToken;
    
            return response([ 'user' => $newUser, 'access_token' => $accessToken]);
        }
    }
}
