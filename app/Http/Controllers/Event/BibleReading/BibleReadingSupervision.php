<?php

namespace App\Http\Controllers\Event\BibleReading;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events\BibleReading\Chapter;
use App\Models\Events\BibleReading\CheckIn;
use App\Models\Events\BibleReading\CheckInChapter;
use App\Models\Events\BibleReading\Comment;
use App\Models\Soul;

class BibleReadingSupervision extends Controller
{

  public function home(Request $request)
  {
  	if($request->cellgroup) {
  		return $this->show_souls($request->cellgroup);
  	}
    return view('event.bible_reading.supervision.home');
  }

  public function show_souls($cellgroup_id)
  {
  	$souls = Soul::where('cellgroup_id', $cellgroup_id)->get();
    if($souls->isNotEmpty()) {
      $check_ins = CheckIn::whereIn('soul_id', $souls->pluck('id'))->get();
      $CheckInChapter = CheckInChapter::whereIn('check_in_id', $check_ins->pluck('id'))->get();
      foreach($souls as $soul) {
        $soul_checkins = $check_ins->where('soul_id', $soul->id);
        $soul['count'] = $this->countRecord($soul_checkins, $CheckInChapter);
      }
    }

  	return view('event.bible_reading.supervision.show_souls', compact('souls'));
  }

  public function countRecord($check_in, $checkInChapter)
  {
      $check_in_chapter = [];
      foreach ($check_in as $checkIn) {
        $check_in_chapter[] = $checkInChapter->where('check_in_id', $checkIn->id);
      }
      $amount = collect([$check_in_chapter])->collapse()->collapse()->pluck('chapter_id')->unique()->count();
      return $amount;
  }
  
}