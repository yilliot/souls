@extends('event.just_begin.layout')

@section('title')
3KM {{trans('event.just_begin.record')}}
@endsection

@section('content')
  <div id="signup-container" class="ui piled inverted segment text container">

    <a href="/event/3km"> <i class="home icon"></i> </a> |
    <a href="/session/lang/zh">中文</a> |
    <a href="/session/lang/en">English</a>

    <h1 class="ui center aligned icon header">
      <div>
        <img id="logo" src="/images/hcc-logo-black320.png" alt="HCCJB">
      </div>
      <div class="neon-green content">
          <span class="glow">3KM {{trans('event.just_begin.record')}}</span>
          <div class="sub neon-green header">
            {{trans('event.just_begin.just_begin')}}
          </div>
        </div>
    </h1>
    @include('event.just_begin.part.flash')

      <table class="ui inverted table">
        <tr>
          <td>{{ trans('attribute.name') }}</td>
          <td> {{ $record->soul->nickname }} </td>
        </tr>
        <tr>
          <td> {{ trans('event.just_begin.meters') }} </td>
          <td> {{ $record->meters}}m </td>
        </tr>
        <tr>
          <td> {{ trans('event.just_begin.minutes') }} </td>
          <td> {{ $record->minutes}}{{trans('event.just_begin.minutes')}} </td>
        </tr>
        <tr>
          <td> CG </td>
          <td> {{ $record->cellgroup }} </td>
        </tr>
        <tr>
          <td> {{ trans('attribute.date') }} </td>
          <td> {{ $record->created_at->format('jS h:iA') }} </td>
        </tr>
      </table>

      <img class="ui image" src="/storage/{{$record->screenshot_path}}" alt="">

  </div>
@endsection