<?php

namespace App\Http\Controllers\Usher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Soul;

class UsherController extends Controller
{
    //
        public function postNewfriend(Request $request)
    {
        $this->validate($request, [
            'nric' => [
                'required',
                'unique:souls,nric',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/'],
            'nric_fullname' => 'required|max:255',
            'email' => 'required|email|unique:souls,email|max:255',
            'nickname' => 'required|max:255',
            'contact' => 'required|between:6,12',
            'address1' => 'required|max:255',
            'address2' => 'required|max:255',
            'birthday' => 'required|date',
            'postal_code' => 'required|digits_between:5,8',
            'cellgroup' => 'required|exists:cellgroups,id',
        ]);

        session()->put('nric', $request->nric);

        $contact_string = preg_replace('/\s+/', '', $request->contact);
        $contact_string = $request->contact_code . ltrim($contact_string, '0');
        $contact2_string = preg_replace('/\s+/', '', $request->contact2);
        $contact2_string = $request->contact2_code . ltrim($contact2_string, '0');

        $soul = new Soul;
        $soul->cellgroup_id = $request->cellgroup_id;
        $soul->nric = $request->nric;
        $soul->nric_fullname = $request->nric_fullname;
        $soul->birthday = $request->birthday;
        $soul->nickname = $request->nickname;
        $soul->email = $request->email;
        $soul->contact = $contact_string;
        $soul->contact2 = $contact2_string;
        $soul->address1 = $request->address1;
        $soul->address2 = $request->address2;
        $soul->postal_code = $request->postal_code;
        $soul->save();

        return back()->with('success', 'success')->with('message', 'created!');

        return redirect('/usher/newfriend/')->with('success', 'success')->with('message', 'Welcome to Harvest Culture ' . $soul->nric);
    }

    public function newfriend()
    {
        return view('usher.newfriend');
    }
}
