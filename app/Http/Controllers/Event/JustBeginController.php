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
            ->orderBy('meters', 'desc')
            ->get();

        $topscore = $records->first()->meters;

        return view('event.just_begin.home', compact('records', 'totals', 'topscore'));
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
            'minutes' => 'required|numeric|min:8|max:300',
            'km' => 'required|numeric|min:1|max:50',
            'screenshot_path' => 'required|image',
        ]);

        $soul = Soul::where('nric', $request->nric)->first();

        session()->put('nric', $request->nric);

        // check last record timing
        $lastRecord = JustBeginRecord::where('soul_id', $soul->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastRecord && $lastRecord->created_at->diffInHours(\Carbon\Carbon::now()) < 8) {
            $message = trans('event.just_begin.message_please_wait', [
                    't1' => $lastRecord->created_at->diffForHumans(\Carbon\Carbon::now()),
                    't2' => $lastRecord->created_at->addHours(8)->format('jS h:iA'),
                ]);
            return back()->with('error', 'rejected')->with('message', $message);
        }



        $meters = $request->km * 1000;

        $record = new JustBeginRecord();
        $record->soul_id = $soul->id;
        $record->cellgroup_id = $soul->cellgroup_id;
        $record->meters = $meters;
        $record->minutes = $request->minutes;
        $record->screenshot_path = $request->screenshot_path->store('events.just_begin', 'public');
        $record->save();

        return redirect('/event/3km/recorded/'.$record->id)->with('success', 'success')->with('message', 'Your record is tracked');
    }

    public function checkin()
    {
        return view('event.just_begin.checkin');
    }
    public function recorded(Request $request)
    {
        $record = JustBeginRecord::find($request->id);
        return view('event.just_begin.recorded', compact('record'));
    }
}