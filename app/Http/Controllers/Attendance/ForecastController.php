<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Soul;
use App\Models\CG;

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
        $cg = CG::find(\Auth::user()->soul->cellgroup_id);
        $members = Soul::where('cellgroup_id', $cg->id)
            ->where('is_active', true)
            ->get();
        $service = Service::with('type', 'venue', 'speaker')
            ->find($id);
        return view('attendance.forecast.get_service', compact('service', 'cg', 'members'));
    }

    public function getGuests(Request $request, $id)
    {
        $service = Service::with('type', 'venue', 'speaker')
            ->find($id);

        return view('attendance.forecast.get_guests', compact('service'));
    }
}
