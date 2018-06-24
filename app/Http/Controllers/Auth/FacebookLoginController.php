<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;

class FacebookLoginController extends Controller
{
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        /*
        // Existing Facebook User
        $facebookUser = FacebookUser::where('token', $user->token);
        if ($facebookUser) {
            // Login
            session()->put('nric', $facebookUser->soul->nric);
            // Redirect to original action page
        } else {
    
        New Facebook User
            // Fill in detail (sign up)
            // Redirect for filling in detail
        }
        */
    }

    public function getUser()
    {
        $token = 'EAAW4HrZC1irsBAOg3VbuGQ1byEUOTDd6HDUEeDlsE8N6NHohxmEvfILYR8B2bH813ebuhCo8w21IKZCrpbEDcp9WYFDMYLkjrZABkcAtyy4Iz4E2Avg6oHoWgQyl7J7qzYJIOYIbZA47u7t0ocSXj7gocbzFc5cZD';
        $user = Socialite::driver('facebook')->userFromToken($token);
        dd($user);
    }
}