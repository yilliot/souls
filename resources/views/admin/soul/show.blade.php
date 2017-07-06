@extends('admin.layout')
@section('title')
Member details
@endsection
@section('content')

<a class="ui large header" href="{{url()->previous()}}" ><i class="arrow left icon"></i>Member Detail</a>
<div class="ui stackable column grid">
  <div class="five wide column">
    <div class="ui fluid card">
      <div class="content">
        @if ($soul->user && $soul->user->hasRole('management'))
          <i class="right floated icon red certificate"></i>
        @endif
        @if ($soul->user && $soul->user->hasRole('admin'))
          <i class="right floated icon red asterisk"></i>
        @endif
        @if ($soul->baptism_serial)
          <i class="right floated icon teal water"></i>
        @endif
        <span class="large header">{{$soul->nickname}}</span>
        <div class="meta"><span class="status">{{prefix()->wrap($soul)}}</span></div><br/>
        <div class="extra content">
          {{$soul->nric}} <br/>
          {{$soul->nric_fullname}} <br/>
          <i class="birthday icon"></i> {{$soul->birthday}} <br/>
          <i class="mail icon"></i>{{$soul->email}}  <br/>
          <i class="home icon"></i>{{$soul->address1}} <br/>
          <i class="icon"></i>{{$soul->address2}} <br/>
          <i class="icon"></i>{{$soul->postal_code}} <br/>

          <br/>
          @if ($soul->is_active)
            <div class="ui green label">active</div>
          @else
            <div class="ui grey label">not active</div>
          @endif
          <br>
          <i class="call icon"></i>{{$soul->contact}}<br/>
          <i class="call icon"></i>{{$soul->contact2}}<br/>
          <i class="wait icon"></i>Join since {{$soul->created_at->toFormattedDateString()}}<br/>
        </div>
      </div>
    </div>
  </div>
  <div class="eleven wide column">
  </div>
</div>
@endsection
