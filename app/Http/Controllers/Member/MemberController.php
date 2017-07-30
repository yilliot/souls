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
    public function getForecastService(Request $request)
    {
        $this->validate($request, [
            'nric' => [
                'required',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/',
                'exists:souls,nric',
            ],
        ]);

        $soul = Soul::where('nric', $request->nric)->first();
        $services = Service::where('at','<=',\Carbon\Carbon::now()->next(\Carbon\Carbon::SUNDAY))
                    ->where('at','>=',\Carbon\Carbon::now(\Carbon\Carbon::SUNDAY))
                    ->orderBy('at')
                    ->get();
        $serviceAttendances = collect([]);
        $attendingServices = ServiceAttendance::where('soul_id',$soul->id)
          ->where('created_at','<=',\Carbon\Carbon::now()->next(\Carbon\Carbon::SUNDAY))
          ->where('created_at','>=',\Carbon\Carbon::now(\Carbon\Carbon::SUNDAY))
          ->whereIn('service_id',$services->pluck('id'))
          ->get();
        foreach($attendingServices as $attendingService){
            if($attendingService)$serviceAttendances->prepend($attendingService);
        }
        if($serviceAttendances->isNotEmpty()){
            $serviceAttendances = $serviceAttendances->sortBy('service_id');
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
        $soul = Soul::where('id', $request->soul_id)->first();
        if ($request->has('services')) {
            $soulAttendance = ServiceAttendance::where('soul_id',$soul->id)
                                               ->where('created_at','<=',\Carbon\Carbon::now()->next(\Carbon\Carbon::SUNDAY))
                                               ->where('created_at','>=',\Carbon\Carbon::now()->previous(\Carbon\Carbon::SUNDAY))
                                               ->get();
            foreach ($request->get('services') as $service_id) {
                if($soulAttendance->where('service_id',$service_id)->isEmpty()){
                $serviceAttendance = new ServiceAttendance;
                $serviceAttendance->service_id = $service_id;
                $serviceAttendance->soul_id = $request->soul_id;
                $serviceAttendance->cellgroup_id = $request->cellgroup_id;
                $serviceAttendance->is_attended = null;
                $serviceAttendance->save();
                Service::find($serviceAttendance->service->id)->cacheAttendance()->save();
                }
            }
        }

        return back()->with('success', 'success')->with('message', 'added');
    }

    public function deleteForecastService(Request $request)
    {
        $serviceAttendance = ServiceAttendance::find($request->id);
        $serviceAttendance->visitors()->delete();
        $serviceAttendance->delete();

        Service::find($serviceAttendance->service->id)->cacheAttendance()->save();
        return back()->with('success', 'success')->with('message', 'deleted');
    }

    public function postVisitor(Request $request)
    {

        $serviceAttendance = ServiceAttendance::where('id', $request->id)->first();
        if ($request->has('visitors')) {

            foreach ($request->get('visitors') as $visitor) {
                if($visitor != null){
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
        }

        return back()->with('success', 'success')->with('message', 'added');
    }

//
    public function deleteVisitor(Request $request)
    {
        $visitor = ServiceVisitor::find($request->id);
        $visitor->delete();
        
        return back()->with('success', 'success')->with('message', 'deleted');
    }

}