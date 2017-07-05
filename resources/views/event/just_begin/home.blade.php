@extends('event.just_begin.layout')

@section('title')
3KM Home
@endsection

@section('content')
  <style>
    .ui.ordered.list .list>.item:before, .ui.ordered.list>.item:before, ol.ui.list li:before {
      margin-left: -1.75rem !important;
      color: white !important;
    }
  </style>
  <div id="signup-container" class="ui piled inverted segment text container">

    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a> |
    <a href="/event/3km/signup"> {{trans('event.just_begin.signup')}} </a> |
    <a href="/event/3km/checkin"> {{trans('event.just_begin.checkin')}} </a>

    <h1 class="ui center aligned icon header">
      <div>
        <img id="logo" src="/images/hcc-logo-black320.png" alt="HCCJB">
        <div> Total {{ number_format($totals->sum('total')/1000) }} KM </div>
      </div>
      <div class="neon-green content">
          <span class="glow">3KM</span>
          <div class="sub neon-green header">
            <div>{{trans('event.just_begin.just_begin')}}</div>
          </div>
        </div>
    </h1>
    @include('event.just_begin.part.flash')

    <h2 class="header">{{trans('event.just_begin.result')}}</h2>
    <div class="ui ordered list">
    @foreach ($totals as $total)
      <div class="item">
        <div class="content">
          <span class="ui large {{$cgs[$total->cellgroup_id]['color']}} label">
            {{$cgs[$total->cellgroup_id]['name']}}
          </span>
          {{number_format($total->total/1000)}} KM
          ( {{$total->count}} runs )
        </div>
        <div style="width: 100%;">
          <div class="ui tiny progress" data-percent="{{$total->total/$topscore*100}}">
            <div class="bar">
            </div>
          </div>
        </div>
      </div>
    @endforeach
    </div>

    <div class="ui divider"></div>

    <h2 class="header">{{trans('event.just_begin.today_records')}}</h2>
    <table class="ui inverted unstackable small compact basic table">
      <thead>
        <tr>
          <th></th>
          <th></th>
          <th class="mobile-hidden">Paces</th>
          <th class="mobile-hidden">Speed</th>
        </tr>
      </thead>
    @forelse ($records as $id => $record)
      <tr data-featherlight="/storage/{{$record->screenshot_path}}">
        <td>
          <div class="ui {{$record->cellgroup->color}} small label">
            {{$record->cellgroup}}
            <div class="detail">{{number_format($record->meters/1000, 2)}}km</div>
          </div>
        </td>
        <td>
          {{$record->soul->nickname}}
        </td>
        <td class="mobile-hidden">
          {{number_format( $record->pace, 2)}} mins/km
        </td>
        <td class="mobile-hidden">
          {{number_format( $record->speed , 2)}} km/h
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="4">
          <div class="ui inverted red basic segment">
            {{trans('event.just_begin.no_result')}}
          </div>
        </td>
      </tr>
    @endforelse
    </table>
  </div>
@endsection
