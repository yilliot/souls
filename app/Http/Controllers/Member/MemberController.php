<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class MemberController extends Controller
{
    //
    public function postForecast(Request $request)
    {
        $this->validate($request, [
            'nric' => [
                'required',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/',
                'exists:souls,nric',
            ],
            //Services Will Attend
        ]);

        $soul = Soul::where('nric', $request->nric)->first();

        // session()->put('nric', $request->nric);

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

		//Check registered forecast void repeated


       
        // $record = new JustBeginRecord();
        // $record->soul_id = $soul->id;
        // $record->cellgroup_id = $request->has('cellgroup_id') ? $request->cellgroup_id : $soul->cellgroup_id;
        // $record->meters = $meters;
        // $record->minutes = $request->minutes;
        // $record->screenshot_path = $request->screenshot_path->store('events.just_begin', 'public');
        // $record->save();

        return redirect('/member/forecast/')->with('success', 'success')->with('message', 'You have registered your forecast');
    }

    public function forecast()
    {
        $services = Service::where('at','>=',\Carbon\Carbon::now())
                    ->where('at','<=',\Carbon\Carbon::now()->addDays(7))
                    ->get();
        return view('member.forecast',compact('services'));
    }
   

}