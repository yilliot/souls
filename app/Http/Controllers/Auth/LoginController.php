<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Soul;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getMergeNric()
    {
        return view('auth.merge_nric');
    }

    public function postMergeNric(Request $request)
    {
        // Validation rules
        $this->validate($request, [
            'nric' => [
                'required',
                'unique:souls,nric',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/'],
        ]);

        // Search if soul exist for this nric
        $soul = Soul::where('nric' ,$request->input('nric'))->first();

        if ($soul) {
            // if soul exist
            // new user merge with souls
            $user = new User;
            $user->email = $soul->email;
            $user->password = '_FB_LOGIN_NO_PASSWORD_';
            $user->first_name = $soul->nric_fullname;
            $user->soul_id = $soul->id;
            $user->facebook_id = $request->session()->pull('facebook_id');
            $user->save();
            \Auth::login($user, true);
            return redirect()->intended('/');
        } else {
            // redirect to details
            return redirect('auth/signup');
        }
    }
}
