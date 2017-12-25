<?php

namespace App\Http\Controllers\Event\BibleReading;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events\BibleReading\Chapter;
use App\Models\Events\BibleReading\CheckIn;
use App\Models\Events\BibleReading\CheckInChapter;
use App\Models\Events\BibleReading\Comment;
use App\Models\Soul;

class BibleReadingController extends Controller
{
    public function home(){
        return view('event.bible_reading.home');
    }

    public function signup(){
        return view('event.bible_reading.signup');
    }

    public function checkin(){
        return view('event.bible_reading.checkin');
    }

    public function history(){
        return view('event.bible_reading.history');
    }

}