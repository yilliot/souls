@extends('event.bible_reading.layout')

@section('title')
Bible Reading Home
@endsection

@section('content')
  
@if(!session('nric'))
<a href="/event/bible_reading/signup"> {{trans('event.bible_reading.signup')}} </a> |
@endif
<a href="/event/bible_reading/checkin"> {{trans('event.bible_reading.checkin')}} </a> | 
<a href="/event/bible_reading/history"> {{trans('event.bible_reading.history')}} </a>
@if(session('nric'))
| <a href="/event/bible_reading/logout"> {{trans('event.bible_reading.logout')}} </a> 
@endif
  
  @include('event.bible_reading.part.logo')
  @include('event.bible_reading.part.flash')
  <style>
    #schedule td{text-align: center; padding: 1px;}
    #schedule th{text-align: center;}
    #schedule td label{display: block;}
    #schedule td span{display:block; font-size: 0.8em;}
  </style>
  <h3 class="ui header">{{ trans('event.bible_reading.timetable', ['month' => trans('event.bible_reading.month.'.\Carbon\Carbon::now()->month)]) }}</h3>
  <table id="schedule" class="ui unstackable compact table">
    <thead>
      <tr>
        <th>Mon</th>
        <th>Tue</th>
        <th>Wed</th>
        <th>Thu</th>
        <th>Fri</th>
        <th>Sat</th>
        <th>Sun</th>
      </tr>
    </thead>
    <tbody>
      @foreach($schedule->chunk(7) as $row)
      <tr>
        @foreach($row as $info)
        @if($info instanceof \App\Models\Events\BibleReading\BibleSchedule)
        <td @if($info->day == \Carbon\Carbon::today()) class="negative"@endif>
          <label>{{ $info->book }}</label>
          <span>{{ $info->verse }}</span>
        </td>
        @else
        <td></td>
        @endif
        @endforeach
      </tr>
      @endforeach
    </tbody>
    
  </table>
  <div class="ui hidden divider"></div>
@endsection
