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
            ->select('cellgroup_id',
                \DB::raw('SUM(meters) as total'),
                \DB::raw('count(id) as count')
                )
            ->groupBy('cellgroup_id')
            ->orderBy('total', 'desc')
            ->get();


        $records = JustBeginRecord::with('cellgroup')->whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-j'))
            ->orderBy('meters', 'desc')
            ->get();

        $topscore = $totals->first()->total;

        $cgs = [
            1 => ['name'=>'W1', 'color'=>'red'],
            2 => ['name'=>'S1', 'color'=>'green'],
            3 => ['name'=>'E1', 'color'=>'blue'],
            4 => ['name'=>'E2', 'color'=>'yellow'],
        ];

        return view('event.just_begin.home', compact('records', 'totals', 'topscore', 'cgs'));
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
        // $lastRecord = JustBeginRecord::where('soul_id', $soul->id)
        //     ->orderBy('created_at', 'desc')
        //     ->first();

        // if ($lastRecord && $lastRecord->created_at->diffInHours(\Carbon\Carbon::now()) < 8) {
        //     $message = trans('event.just_begin.message_please_wait', [
        //             't1' => $lastRecord->created_at->diffForHumans(\Carbon\Carbon::now()),
        //             't2' => $lastRecord->created_at->addHours(8)->format('jS h:iA'),
        //         ]);
        //     return back()->with('error', 'rejected')->with('message', $message);
        // }

        $count = JustBeginRecord::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-j'))
            ->where('soul_id', $soul->id)
            ->count();
        if ($count >= 3) {
            return back()->with('error', 'rejected')->with('message', '为了健康着想，你一天还是不要跑太多次了！😝');
        }


        $meters = $request->km * 1000;

        $record = new JustBeginRecord();
        $record->soul_id = $soul->id;
        $record->cellgroup_id = $request->has('cellgroup_id') ? $request->cellgroup_id : $soul->cellgroup_id;
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

    public function validation()
    {
        $records = JustBeginRecord::orderBy('created_at', 'desc')->get();
        return view('event.just_begin.validation', compact('records'));
    }

    public function searchClaim(){
        $souls_nric = Soul::get()->pluck('nric', 'id');
        return view('event.just_begin.search_claim', compact('souls_nric'));
    }
    public function adminSearchClaim(){
        $souls_nric = Soul::get()->pluck('nric', 'id');
        return view('event.just_begin.admin_search_claim', compact('souls_nric'));
    }
    public function claim(Request $request){

        if ($request->has('nric')) {
            $soul = Soul::where('nric', $request->nric)->first();
        } else {
            $soul = Soul::find($request->soul_id);
        }
        if (!$soul) {
            return redirect()->back()->with('message', 'Record not found')->with('error', 'error');
        }
        $records = JustBeginRecord::where('soul_id', $soul->id)->get();
        return view('event.just_begin.claim', compact('records', 'soul'));
    }
    public function postClaim(Request $request){

    }
}