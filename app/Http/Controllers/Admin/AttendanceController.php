<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Soul;
use App\Models\Cellgroup;
use App\Models\ServiceVisitor;
use App\Models\ServiceAttendance;

class AttendanceController extends Controller
{
    public function index(Request $request, $service)
    {
        $cellgroup = Cellgroup::find($request->cellgroup);
        $attendances = ServiceAttendance::with('soul', 'visitors')
            ->where('service_id', $service)
            ->where('cellgroup_id', $request->get('cellgroup'))
            ->get();

        $service = Service::find($service);

        $is_attendance = \Carbon\Carbon::now()->gte($service->at);

        if ($is_attendance) {
            return $this->doAttendance($request, $service, $cellgroup, $attendances);
        } else {
            return $this->doForecast($request, $service, $cellgroup, $attendances);
        }
    }

    public function doForecast(Request $request, Service $service, Cellgroup $cellgroup, $attendances)
    {
        $souls = Soul::where('cellgroup_id', $request->get('cellgroup'))
            ->get();

        $attendance_souls = $attendances->pluck('soul');
        $remaining_souls = $souls->diff($attendance_souls);

        return view('admin.service.forecast', compact([
            'service',
            'cellgroup',
            'souls',
            'remaining_souls',
            'attendances',
        ]));
    }

    public function doAttendance(Request $request, Service $service, Cellgroup $cellgroup, $attendances)
    {
        return view('admin.service.attendance', compact([
            'service',
            'cellgroup',
            'souls',
        ]));
    }

    public function add(Request $request)
    {
        foreach ($request->get('souls') as $soul_id) {
            $serviceAttendance = new ServiceAttendance;
            $serviceAttendance->service_id = $request->service_id;
            $serviceAttendance->soul_id = $soul_id;
            $serviceAttendance->cellgroup_id = $request->cellgroup_id;
            $serviceAttendance->is_attended = null;
            $serviceAttendance->save();
        }

        Service::find($request->service_id)->cacheAttendance()->save();

        return back()->with('success', 'success')->with('message', 'added');
    }
    public function delete(Request $request)
    {
        $serviceAttendance = ServiceAttendance::find($request->id);
        $serviceAttendance->visitors()->delete();
        $serviceAttendance->delete();

        Service::find($request->service_id)->cacheAttendance()->save();

        return back()->with('success', 'success')->with('message', 'deleted');
    }
    public function attended(Request $request)
    {
        $serviceAttendance = ServiceAttendance::find($request->id);
        $serviceAttendance->is_attended = true;
        $serviceAttendance->save();

        Service::find($request->service_id)->cacheAttendance()->save();

        return back()->with('success', 'success')->with('message', 'flag attended');
    }

    public function absent(Request $request)
    {
        $serviceAttendance = ServiceAttendance::find($request->id);
        $serviceAttendance->is_attended = false;
        $serviceAttendance->save();

        Service::find($request->service_id)->cacheAttendance()->save();

        return back()->with('success', 'success')->with('message', 'flag absent');
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

    public function destroyVisitor(Request $request)
    {
        $visitor = ServiceVisitor::find($request->id);
        $visitor->delete();
        return back()->with('success', 'success')->with('message', 'visitor deleted');
    }

}
