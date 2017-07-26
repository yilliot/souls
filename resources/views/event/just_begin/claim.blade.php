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
          <td> {{ $soul->nickname }} </td>
        </tr>
        <tr>
          <td> 总距离 </td>
          <td> {{ $records->sum('meters')/1000}}km </td>
        </tr>
        <tr>
          <td> 总时间 </td>
          <td> {{ $records->sum('minutes')}}{{trans('event.just_begin.minutes')}} </td>
        </tr>
        <tr>
          <td> 所跑小组 </td>
          <td>
            @foreach ($records->pluck('cellgroup')->unique()->pluck('name') as $cg)
              <div>{{$cg}}</div>
            @endforeach
          </td>
        </tr>
      </table>

      <div class="ui hidden divider"></div>

      <div class="field">
        <div class="ui two basic huge inverted buttons">
        <a href="/event/3km/search_claim" class="ui button">Back</a>
          
        <a href="/event/3km/search_claim" class="ui button">Claim</a>
        </div>
      </div>


  </div>
@endsection