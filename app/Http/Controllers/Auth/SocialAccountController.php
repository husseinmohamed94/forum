<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\socialAccountService;

class SocialAccountController extends Controller
{
    public function redirectToProvider($provider)
    {
      return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(socialAccountService $profileService,$provider)
    {
       try{
        $user = Socialite::driver($provider)->user();
       }catch(\Exception $e){
        return redirect()->to('login');
       }
       $authUser = $profileService->findOrCreate($user,$provider);
      auth()->login($authUser,true); 
      return redirect()->to('home');

    }
}
