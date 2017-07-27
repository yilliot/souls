<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceAttendance;
use App\Models\ServiceVisitor;
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

        Service::find($serviceAttendance->service->id)->cacheAttendance()->save();
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
        $serviceAttendance = ServiceAttendance::find($request->id);
        $serviceAttendance->visitors()->delete();
        $serviceAttendance->delete();

        Service::find($serviceAttendance->service->id)->cacheAttendance()->save();
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

    public function forecastService()
    {
        return view('member.forecastService');
    }


    public function postVisitor(Request $request)
    {
        $serviceAttendance = ServiceAttendance::where('id', $request->id)->first();
        if ($request->has('visitors')) {
            foreach ($request->get('visitors') as $visitor) {
                $serviceVisitor = new ServiceVisitor;
                $serviceVisitor->attendance_id = $serviceAttendance->id;
                $serviceVisitor->service_id = $serviceAttendance->service_id;
                $serviceVisitor->soul_id = $request->soul_id;
                $serviceVisitor->cellgroup_id = $serviceAttendance->cellgroup_id;
                $serviceVisitor->is_attended = null;
                $serviceVisitor->name = $visitor;
                $serviceVisitor->save();
            }
        }

        Service::find($visitor->service->id)->cacheAttendance()->save();
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

//
    public function deleteVisitor(Request $request)
    {
        $visitor = ServiceVisitor::find($request->id);
        $visitor->delete();

        Service::find($visitor->service->id)->cacheAttendance()->save();
        
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

    public function visitor()
    {
        return view('member.forecastVisitor');
    }
   
}