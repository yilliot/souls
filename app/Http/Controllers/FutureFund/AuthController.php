<?php

namespace App\Http\Controllers\FutureFund;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FutureFund\Session;
use App\Models\FutureFund\Pledge;
use App\Models\FutureFund\Payment;

class MemberController extends Controller
{

    function findNric(Request $request)
    {
        $this->validate($request, [
            'nric' => [
                'required',
                'regex:/^(\d{6}-\d{2}-\d{4}|[A-PR-WY]\w{6,10})$/'],
        ]);



    }
}