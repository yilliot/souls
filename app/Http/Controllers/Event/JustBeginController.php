<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soul;
use App\Models\Events\JustBeginRecord;

class JustBeginController extends Controller
{
    public function home()
    {
        $totals = \DB::table('e01_just_begin_records')
            ->select('cellgroup_id', \DB::raw('SUM(meters) as total'))
            ->groupBy('cellgroup_id')
            ->get()
            ->pluck('total', 'cellgroup_id');

        $records = JustBeginRecord::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-j'))
            ->get();

        return view('event.just_begin.home', compact('records', 'totals'));
    }

    public function postSignup(Request $request)
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
            'cellgroup_id' => 'required|exists:cellgroups,id',
        ]);

        session()->put('nric', $request->nric);

        $contact_string = preg_replace('/\s+/', '', $request->contact);
        $contact_string = $request->contact_code . ltrim($contact_string, '0');

        $soul = new Soul;
        $soul->cellgroup_id = $request->cellgroup_id;
        $soul->nric = $request->nric;
        $soul->nric_fullname = $request->nric_fullname;
        $soul->birthday = $request->birthday;
        $soul->nickname = $request->nickname;
        $soul->email = $request->email;
        $soul->contact = $contact_string;
        $soul->address1 = $request->address1;
        $soul->address2 = $request->address2;
        $soul->postal_code = $request->postal_code;
        $soul->save();

        return redirect('/event/3km/checkin')->with('success', 'success')->with('message', 'You can now track your 3km with ' . $soul->nric);
    }

    public function signup()
    {
        return view('event.just_begin.signup');
    }

    public function postCheckin(Request $request)
    {
        $this->validate($request, [
            'nric' => [
                'required',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/',
                'exists:souls,nric',
            ],
            'km' => 'required|numeric|min:0|max:50',
            'screenshot_path' => 'required|image',
        ]);

        $soul = Soul::where('nric', $request->nric)->first();

        session()->put('nric', $request->nric);

        $meters = $request->km * 1000;

        $record = new JustBeginRecord();
        $record->soul_id = $soul->id;
        $record->cellgroup_id = $soul->cellgroup_id;
        $record->meters = $meters;
        $record->screenshot_path = $request->screenshot_path->store('events.just_begin', 'public');
        $record->save();

        return redirect('/event/3km/recorded/'.$record->id)->with('success', 'success')->with('message', 'Your record is tracked');
    }

    public function checkin()
    {
        if (session()->has('nric')) {
            $nric = session()->get('nric');
            $soul = Soul::where('nric', $nric)->first();
            $record = JustBeginRecord::where('soul_id', $soul->id)->whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-j'))->first();
            if ($record) 
               return redirect('/event/3km/recorded/'.$record->id)->with('success', 'success')->with('message', 'Your record is tracked'); 
        }
        return view('event.just_begin.checkin');
    }
    public function recorded(Request $request)
    {
        $record = JustBeginRecord::find($request->id);
        return view('event.just_begin.recorded', compact('record'));
    }
}