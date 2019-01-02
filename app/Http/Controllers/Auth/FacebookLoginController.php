<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;

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
        $facebookUser = Socialite::driver('facebook')->stateless()->user();

        $user = User::where('facebook_id', $facebookUser->id)->first();

        if($user) {
            // User exist, login
            \Auth::login($user, true);
            return redirect()->intended('/');

        } else {
            // FB user doesn't exist 
            // create user from FB

            $socialiteFbUser = Socialite::driver('facebook')
                ->fields([
                    'name',
                    'first_name',
                    'last_name',
                    'email',
                    'gender',
                    'verified',
                    'link',
                ])
            ->userFromToken($facebookUser->token);

            $user = new User;
            $user->email = $socialiteFbUser->email;
            $user->password = '_FB_LOGIN_NO_PASSWORD_';
            $user->first_name = $socialiteFbUser->user['first_name'];
            $user->last_name = $socialiteFbUser->user['last_name'];
            $user->soul_id = null;
            $user->facebook_id = $socialiteFbUser->id;
            $user->save();

            \Auth::login($user, true);
            return redirect('/auth/merge/nric');
        }
    }

    public function getUser()
    {
        $token = 'EAAW4HrZC1irsBAOg3VbuGQ1byEUOTDd6HDUEeDlsE8N6NHohxmEvfILYR8B2bH813ebuhCo8w21IKZCrpbEDcp9WYFDMYLkjrZABkcAtyy4Iz4E2Avg6oHoWgQyl7J7qzYJIOYIbZA47u7t0ocSXj7gocbzFc5cZD';
        $user = Socialite::driver('facebook')->userFromToken($token);
        dd($user);
    }
}