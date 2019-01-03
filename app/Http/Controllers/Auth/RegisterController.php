<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Soul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $soul = Soul::where('nric', $request->input('nric'))->first();

        if ($soul && $soul->user)
            return redirect('/auth/login');

        if ($soul) {
            return view('auth.signup_merge_nric', compact('soul'));
        }
        return view('auth.register');
    }

    public function postMergeNric(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|max:255',
        ]);

        $soul = Soul::find($request->input('soul_id'));

        $user = new User;
        $user->soul_id = $soul->id;
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->first_name = $soul->nickname;
        $user->save();
        \Auth::login($user, true);
        return redirect()->intended('/');


    }

    protected function postRegistrationForm(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|max:255',
            'nric' => ['required',
                'max:255',
                'unique:souls,nric',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/',
            ],
            'nric_fullname' => 'required|max:255',
            'nickname' => 'required|max:255',
            'contact' => 'required|between:10,11',
            'address1' => 'required|max:255',
            'address2' => 'required|max:255',
            'birthday' => 'required|date',
            'postal_code' => 'required|digits_between:5,8',
            'cellgroup_id' => 'required|exists:cellgroups,id',
        ]);

        $soul = new Soul;
        $soul->nric = $request->session()->pull('nric');
        $soul->nric_fullname = $request->input('nric_fullname');
        $soul->email = $request->input('email');
        $soul->nickname = $request->input('nickname');
        $soul->contact = $request->input('contact');
        $soul->address1 = $request->input('address1');
        $soul->address2 = $request->input('address2');
        $soul->postal_code = $request->input('postal_code');
        $soul->cellgroup_id = $request->input('cellgroup_id');
        $soul->birthday = $request->input('birthday');
        $soul->save();

        $user = new User;
        $user->soul_id = $soul->id;
        // $user->facebook_id = $request->session()->pull('facebook_id');
        $user->email = $soul->email;
        $user->password = bcrypt($request->input('password'));
        $user->first_name = $soul->nickname;
        $user->save();
        \Auth::login($user, true);
        return redirect()->intended('/');
    }
}
