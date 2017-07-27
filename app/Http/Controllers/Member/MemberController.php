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
                    ->get()
                    ->sortBy('at');
        $serviceAttendances = collect([]);
        $temp = collect([]);
        foreach($services as $service){
            $attendingService = ServiceAttendance::where('soul_id',$soul->id)
                                                          ->where('created_at','<=',\Carbon\Carbon::now()->next(\Carbon\Carbon::SUNDAY))
                                                          ->where('created_at','>=',\Carbon\Carbon::now()->previous(\Carbon\Carbon::SUNDAY))
                                                          ->where('service_id',$service->id)
                                                          ->first();
            if($attendingService != null)$serviceAttendances->prepend($attendingService);
        }
        if($serviceAttendances->isNotEmpty()){
            $serviceAttendances = $serviceAttendances->reverse();
            foreach($serviceAttendances as $serviceAttendance){
                $services->splice($services->search($serviceAttendance->service),1);
            }
        }

        return view('member.forecastService',compact('soul','services','serviceAttendances'));
        // return redirect('/member/forecast/service')->with('success', 'success')->with('message', 'You have registered your forecast');
    }

    public function forecast()
    {
        return view('member.forecast');
    }

    public function postForecastService(Request $request)
    {
        if ($request->has('services')) {
            foreach ($request->get('services') as $service_id) {
                $serviceAttendance = new ServiceAttendance;
                $serviceAttendance->service_id = $service_id;
                $serviceAttendance->soul_id = $request->soul_id;
                $serviceAttendance->cellgroup_id = $request->cellgroup_id;
                $serviceAttendance->is_attended = null;
                $serviceAttendance->save();
            }
        }

        $soul = Soul::where('id', $request->soul_id)->first();
        $services = Service::where('at','<=',\Carbon\Carbon::now()->next(\Carbon\Carbon::SUNDAY))
                    ->where('at','>=',\Carbon\Carbon::now()->previous(\Carbon\Carbon::SUNDAY))
                    ->get()
                    ->sortBy('at');
        $serviceAttendances = collect([]);
        $temp = collect([]);
        foreach($services as $service){
            $attendingService = ServiceAttendance::where('soul_id',$soul->id)
                                                          ->where('created_at','<=',\Carbon\Carbon::now()->next(\Carbon\Carbon::SUNDAY))
                                                          ->where('created_at','>=',\Carbon\Carbon::now()->previous(\Carbon\Carbon::SUNDAY))
                                                          ->where('service_id',$service->id)
                                                          ->first();
            if($attendingService != null)$serviceAttendances->prepend($attendingService);
        }
        if($serviceAttendances->isNotEmpty()){
            $serviceAttendances = $serviceAttendances->reverse();
            foreach($serviceAttendances as $serviceAttendance){
                $services->splice($services->search($serviceAttendance->service),1);
            }
        }

        return view('member.forecastService',compact('soul','services','serviceAttendances'));
    }

    public function deleteForecastService(Request $request)
    {

    }

    public function forecastService()
    {
        return view('member.forecastService');
    }

    public function postVisitor(Request $request)
    {
        return redirect('/member/forecast/service');
    }

    public function deleteVisitor(Request $request)
    {

    }

    public function visitor()
    {
        return view('member.forecastVisitor');
    }
   
}