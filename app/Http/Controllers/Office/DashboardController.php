<?php

namespace App\Http\Controllers\Office;

class DashboardController extends OfficeController
{
    public function index()
    {
        return view('office.home');
    }
}