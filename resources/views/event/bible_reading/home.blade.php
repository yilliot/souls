@extends('event.bible_reading.layout')

@section('title')
Bible Reading Home
@endsection

@section('content')
  |
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

  <div class="ui hidden divider"></div>

  <h2 class="header">{{trans('event.bible_reading.today_records')}}</h2>
  @forelse($comments as $comment)
  @include('event.bible_reading.part.comment', ['comment' => $comment])
  @empty
  <tr>
    <td colspan="4">
      <div class="ui inverted red basic segment">
        {{trans('event.bible_reading.today_no_result')}}
      </div>
    </td>
  </tr>
  @endforelse
  
@endsection
