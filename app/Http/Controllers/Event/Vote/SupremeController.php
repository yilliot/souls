<?php

namespace App\Http\Controllers\Event\Vote;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events\SupremeVoteRecord;

class SupremeController extends Controller
{
    public function s01(Request $request)
    {
        if (session('supreme.vote'))
            return redirect('/event/vote/supreme/message');
        return view('event.supreme.s01');
    }

    public function message(Request $request)
    {
        if (!session('supreme.vote'))
            return redirect('/event/vote/supreme');
        return view('event.supreme.message');
    }

    public function postS01(Request $request)
    {

        $record = new \App\Models\Events\SupremeVoteRecord;
        $record->option = $request->option;
        $record->save();
        session(['supreme.vote' => $request->option]);
        return redirect('/event/vote/supreme/message');
    }
}