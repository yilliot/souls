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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function postRegistrationForm(Request $request)
    {
        $this->validate($request, [
            'nric_fullname' => 'required|max:255',
            'email' => 'required|email|unique:souls,email|max:255',
            'nickname' => 'required|max:255',
            'contact' => 'required|between:6,12',
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
        $soul->save();

        $user = new User;
        $user->soul_id = $soul->id;
        $user->facebook_id = $request->session()->pull('facebook_id');
        $user->email = $soul->email;
        $user->password = '_FB_LOGIN_NO_PASSWORD_';
        $user->first_name = $soul->nric_fullname;
        $user->save();
        \Auth::login($user, true);
        return redirect()->intended('/');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
