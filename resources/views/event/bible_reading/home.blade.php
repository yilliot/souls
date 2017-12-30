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

  <h2 class="header">{{trans('event.bible_reading.result')}}</h2>
  <div class="ui ordered list">
  @foreach ($totals as $total)
  <div class="item">
    <div class="content">
          {{ $total['name'] }} : 
        
      {{ trans('event.bible_reading.chapter_read_count') . ': ' . $total['count'] . ' ' . trans('event.bible_reading.chapter') }}
    </div>
    <div class="ui {{ $total['color']}} progress" data-value="{{ $total['count'] }}" data-total="{{ $topScore * 1.2 }}">
      <div class="bar"></div>
    </div>
  </div>
  @endforeach
  </div>

  <div class="ui divider"></div>

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
