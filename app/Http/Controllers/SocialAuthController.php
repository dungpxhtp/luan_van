<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;
class SocialAuthController extends Controller
{
    //
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderCallback()
    {

    }
}
