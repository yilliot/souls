<?php

namespace App\Services;

use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;

class ServicesGenerator
{
    public function scheduler(Carbon $from, $months = 3)
    {
        $last_at = $from->copy();

        $last = Service::where('created_by', 0)
            ->orderBy('at', 'desc')
            ->first();
        if ($last)
            $last_at = $last->at;

        $till = $from->copy()->addMonths($months);

        while ($till->gt($from)) {

            // SATURDAY SERVICE
            if ($last_at->lt($from) && $this->is_right_day_for_service($from)) {

                $service_timing = $this->make_service_timing($from);
                $this->service_maker($service_timing);
            }

            // SUPREME SERVICE
            if ($last_at->lt($from) && $this->is_right_day_for_supreme($from)) {

                $service_timing = $this->make_supreme_timing($from);
                $this->supreme_maker($service_timing);
            }
            $from->addDay();
        }
    }

    protected function make_service_timing(Carbon $dt)
    {
        $dt->hour = 17;
        $dt->minute = 0;
        $dt->second = 0;
        return $dt;
    }

    protected function make_supreme_timing(Carbon $dt)
    {
        $dt->hour = 19;
        $dt->minute = 0;
        $dt->second = 0;
        return $dt;
    }

    protected function is_right_day_for_service(Carbon $dt)
    {
        return $dt->dayOfWeek === Carbon::SATURDAY;
    }
    protected function is_right_day_for_supreme(Carbon $dt)
    {
        return $dt->dayOfWeek === Carbon::FRIDAY;
    }

    public function service_maker($dt)
    {
        $service = new Service();
        $service->at = $dt;
        $service->type_id = 1;
        $service->venue_id = 1;
        $service->speaker_id = 1;
        $service->forecast_size = 0;
        $service->attendance_size = 0;
        $service->created_by = 0;
        $service->save();
    }
    public function supreme_maker($dt)
    {
        $service = new Service();
        $service->at = $dt;
        $service->type_id = 2;
        $service->venue_id = 1;
        $service->speaker_id = 1;
        $service->forecast_size = 0;
        $service->attendance_size = 0;
        $service->created_by = 0;
        $service->save();
    }
}