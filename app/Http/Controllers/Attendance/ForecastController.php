<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Soul;
use App\Models\Cellgroup;

class ForecastController extends Controller
{
    public function index()
    {
        return redirect('/attendance/forecast/services');
    }

    public function getServices()
    {
        $services = Service::with('type', 'venue', 'speaker')
            ->where('at', '>', \Carbon\Carbon::now()->format('Y-m-d'))
            ->orderBy('at', 'asc')
            ->get();

        return view('attendance.forecast.get_services', compact('services'));
    }
    public function getService(Request $request, $id)
    {
        $cg = Cellgroup::find(\Auth::user()->soul->cellgroup_id);
        $members = Soul::where('cellgroup_id', $cg->id)
            ->where('is_active', true)
            ->get();
        $service = Service::with('type', 'venue', 'speaker')
            ->find($id);
        return view('attendance.forecast.get_service', compact('service', 'cg', 'members'));
    }

    public function doForecast(Request $request, Service $service, Cellgroup $cellgroup, $attendances, $visitors)
    {
        $souls = Soul::where('cellgroup_id', $request->get('cellgroup'))
            ->orderBy('created_at', 'desc')
            ->get();

        $attendance_souls = $attendances->pluck('soul');
        $remaining_souls = $souls->diff($attendance_souls);

        return view('admin.service.forecast', compact([
            'service',
            'visitors',
            'cellgroup',
            'souls',
            'remaining_souls',
            'attendances',
        ]));
    }

    public function doAttendance(Request $request, Service $service, Cellgroup $cellgroup, $attendances, $visitors)
    {
        return view('admin.service.attendance', compact([
            'service',
            'visitors',
            'cellgroup',
            'attendances',
        ]));
    }

    public function postAdd(Request $request)
    {
        if ($request->has('souls')) {
            $tobeInserted = $request->souls;

            $attendedSoulId = ServiceAttendance::where('service_id', $request->service_id)
                ->whereIn('soul_id', $request->souls)
                ->get()
                ->pluck('soul_id');
            if ($attendedSoulId) {
                $tobeInserted = collect($request->souls)
                    ->diff($attendedSoulId);
            }


            foreach ($tobeInserted as $soul_id) {
                $serviceAttendance = new ServiceAttendance;
                $serviceAttendance->service_id = $request->service_id;
                $serviceAttendance->soul_id = $soul_id;
                $serviceAttendance->cellgroup_id = $request->cellgroup_id;
                $serviceAttendance->is_attended = null;
                $serviceAttendance->save();
            }
        }
        Service::find($request->service_id)->cacheAttendance()->save();
        return back()->with('success', 'success')->with('message', 'added');
    }
    public function postDelete(Request $request)
    {
        $serviceAttendance = ServiceAttendance::find($request->id);
        $serviceAttendance->visitors()->delete();
        $serviceAttendance->delete();

        Service::find($request->service_id)->cacheAttendance()->save();

        return back()->with('success', 'success')->with('message', 'deleted');
    }
    public function postAttended(Request $request)
    {
        if (collect($request->get('visitor'))->count()) {
            ServiceVisitor::whereIn('id', $request->get('visitor'))
                ->update(['is_attended' => true]);
        }
        if (collect($request->get('attendance'))->count()) {
            ServiceAttendance::whereIn('id', $request->get('attendance'))
                ->update(['is_attended' => true]);
        }

        Service::find($request->service_id)->cacheAttendance()->save();

        return back()->with('success', 'success')->with('message', 'flag attended');
    }

    public function postReset(Request $request)
    {
        if ($request->type == 'visitor') {
            $obj = ServiceVisitor::find($request->id);
        } else {
            $obj = ServiceAttendance::find($request->id);
        }
        $obj->is_attended = null;
        $obj->save();

        Service::find($request->service_id)->cacheAttendance()->save();

        return back()->with('success', 'success')->with('message', 'flag reset');
    }

    public function visitor(Request $request, $id)
    {
        $attendance = ServiceAttendance::find($id);
        return view('admin.service.visitor', compact('attendance'));
    }

    public function postVisitor(Request $request)
    {
        foreach ($request->get('visitor') as $visitor) {
            $visitor = trim($visitor);
            if ($visitor) {
                $serviceVisitor = new ServiceVisitor;
                $serviceVisitor->attendance_id = $request->attendance_id;
                $serviceVisitor->soul_id = $request->soul_id;
                $serviceVisitor->service_id = $request->service_id;
                $serviceVisitor->cellgroup_id = $request->cellgroup_id;
                $serviceVisitor->name = $visitor;
                $serviceVisitor->is_attended = null;
                $serviceVisitor->save();
            }
        }

        return back()->with('success', 'success')->with('message', 'updated');
    }

    public function postDeleteVisitor(Request $request)
    {
        $visitor = ServiceVisitor::find($request->id);
        $visitor->delete();
        return back()->with('success', 'success')->with('message', 'visitor deleted');
    }

}
