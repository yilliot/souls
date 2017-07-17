<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Soul;
use App\Models\ServiceAttendance;

class AttendanceController extends Controller
{
    public function index(Request $request, $service)
    {
        $attendances = ServiceAttendance::with('soul')->where('service_id', $service)
            ->where('cellgroup_id', $request->get('cellgroup'))
            ->get();

        $service = Service::find($service);

        $is_attendance = \Carbon\Carbon::now()->gte($service->at);

        if ($is_attendance) {
            return $this->doAttendance($request, $service, $attendances);
        } else {
            return $this->doForecast($request, $service, $attendances);
        }
    }

    public function doForecast(Request $request, Service $service, $attendances)
    {
        $souls = Soul::where('cellgroup_id', $request->get('cellgroup'))
            ->get();

        $attended_souls = $attendances->pluck('soul');
        $remaining_souls = $souls->diff($attended_souls);

        return view('admin.service.forecast', compact([
            'service',
            'souls',
            'remaining_souls',
            'attendances',
        ]));
    }

    public function doAttendance(Request $request, Service $service, $attendances)
    {
        return view('admin.service.attendance', compact([
            'service',
            'souls',
        ]));
    }

}
