<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AppleAuthController extends Controller
{
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function handleCallback()
    {
        $user = Socialite::driver('apple')->user();
    
        $findUser = User::where('social_id', $user->id)->first();
    
        if($finduser){
            $accessToken = $findUser->createToken('authToken')->accessToken;
            
            return response([ 'user' => $findUser, 'access_token' => $accessToken]);
        }else{
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_id'=> $user->id,
                'social_type'=> 'apple',
                // FIXME: this should be a random string
                'password' => bcrypt('my-apple')
            ]);
    
            $accessToken = $newUser->createToken('authToken')->accessToken;
    
            return response([ 'user' => $newUser, 'access_token' => $accessToken]);
        }
    }
}
