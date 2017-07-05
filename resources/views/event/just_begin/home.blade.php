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
        <div> Total {{ number_format($totals->sum()) }} Meters </div>
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
    <table class="ui inverted unstackable compact table mobile-only">
      <tr>
        <th>W1</th>
        <td>{{number_format($totals->get(1, 0))}}</td>
      </tr>
      <tr>
        <th>S1</th>
        <td>{{number_format($totals->get(2, 0))}}</td>
      </tr>
      <tr>
        <th>E1</th>
        <td>{{number_format($totals->get(3, 0))}}</td>
      </tr>
      <tr>
        <th>E1</th>
        <td>{{number_format($totals->get(4, 0))}}</td>
      </tr>
    </table>
    <table class="ui inverted unstackable compact table mobile-hidden">
      <thead>
        <tr class="center aligned">
          <th class="one wide">W1</th>
          <th class="one wide">S1</th>
          <th class="one wide">E1</th>
          <th class="one wide">E2</th>
        </tr>
      </thead>
      <tr class="center aligned">
        <td>{{number_format($totals->get(1, 0))}}</td>
        <td>{{number_format($totals->get(2, 0))}}</td>
        <td>{{number_format($totals->get(3, 0))}}</td>
        <td>{{number_format($totals->get(4, 0))}}</td>
      </tr>
    </table>

    <div>* unit in meter</div>

    <div class="ui divider"></div>

    <h2 class="header">{{trans('event.just_begin.today_records')}}</h2>
    <div class="ui ordered list">
    @forelse ($records as $record)
      <div class="item">
        <div class="content">
          <span class="ui {{$record->cellgroup->color}} label">
            {{$record->cellgroup}}
          </span>
          {{$record->soul->nickname}} : <a href="#" data-featherlight="/storage/{{$record->screenshot_path}}">{{number_format($record->meters/1000, 2)}}km ({{number_format( $record->minutes / ($record->meters/1000), 2)}}m/km)</a>
          <div style="width: 100%;">
            <div class="ui tiny progress" data-percent="{{$record->meters/$topscore*100}}">
              <div class="bar">
              </div>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="item">
        <div class="content">
          <div class="ui inverted red basic segment">
            {{trans('event.just_begin.no_result')}}
          </div>
        </div>
      </div>
    @endforelse
    </div>

  </div>
@endsection
