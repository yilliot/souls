<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceAttendance;
use App\Models\Soul;

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
        $services = Service::where('at','<=',\Carbon\Carbon::now()->next(\Carbon\Carbon::SUNDAY))
                    ->where('at','>=',\Carbon\Carbon::now()->previous(\Carbon\Carbon::SUNDAY))
                    ->get();
        $service_ids = collect([]);
        foreach($services as $service){
            $service_ids->prepend($service->id);
        }
        $serviceAttendances = ServiceAttendance::where('soul_id',$soul->id)
                                              ->where('service_id',$service_ids->toArray());
        return view('member.forecastService',compact('soul','services','serviceAttendances'));
        // return redirect('/member/forecast/service')->with('success', 'success')->with('message', 'You have registered your forecast');
    }

    public function forecast()
    {
        return view('member.forecast');
    }

    public function postForecastService()
    {
        return redirect('/member/forecast/service');
    }

    public function forecastService()
    {
        return view('member.forecastService');
    }

    public function postVisitor()
    {
        return redirect('/member/forecast/service');
    }

    public function visitor()
    {
        return view('member.forecastVisitor');
    }
   

}