@extends('session.layout')

@section('title')
Invitation
@endsection

@section('content')

<div id="secure" style="z-index:999; position: fixed; top:0;left:0;right:0;">
  {{-- <a href="/auth/redirect/nric?redirect_url=/invite/member" class="ui mini red fluid button">click here if you're a member</a> --}}
</div>

<div class="ui horizontal divider">{{$soul}}'s calendar</div>
<table class="ui very compact unstackable table">
  <thead>
    <tr>
      <th>Date</th>
      <th></th>
      <th>Time/Venue</th>
      <th>RSVP</th>
    </tr>
  </thead>
@forelse ($invitations as $invitation)
@if (get_class($invitation) == 'App\Models\Session\Invitation')
@php
  $color = '';
  if ($invitation) {
    if ($invitation->is_coming === 0) $color = 'negative';
    elseif ($invitation->is_coming === 1) $color = 'positive';
  }
@endphp
<tr class="{{$color}}">
  <td>
    <div>{{$invitation->start_at->format('d M')}}</div>
    <div>{{$invitation->start_at->format('D')}}</div>
  </td>
  <td>
    {{$invitation->session}}
    @if ($invitation->session->type)
      <div>({{$invitation->session->type}})</div>
    @endif
  </td>
  <td>
    <div>{{$invitation->start_at->format('h:i A')}}</div>
    @if ($invitation->session->venue)
      <div>{{$invitation->session->venue}}</div>
    @endif
  </td>
  <td>
    <form action="/invite/response" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="session_id" value="{{$invitation->session->id}}">
    <input type="hidden" name="soul_id" value="{{$soul->id}}">
    <div class="ui mini buttons">
    @if ($invitation->is_coming === 0)
      <button type='submit' name='action' value="1" class="ui teal button">change to YES</button>
    @elseif ($invitation->is_coming === 1)
      <button type='submit' name='action' value="0" class="ui pink button">change to no</button>
    @else
      <button type='submit' name='action' value="1" class="ui teal button">YES</button>
      <button type='submit' name='action' value="0" class="ui pink button">No</button>
    @endif
    </div>
    </form>
    <div>
      @if ($invitation)
        @if ($invitation->is_coming === 0)
          <div>not going</div>
        @elseif ($invitation->is_coming === 1)
          <div>going</div>
        @else
          please response
        @endif
      @else
        please response
      @endif
    </div>
  </td>
</tr>
@else
@php
  $session = $invitation;
@endphp
<tr class="">
  <td>
    <div>{{$session->start_at->format('d M')}}</div>
    <div>{{$session->start_at->format('D')}}</div>
  </td>
  <td>
    {{$session}}
    @if ($session->type)
      <div>({{$session->type}})</div>
    @endif
  </td>
  <td>
    <div>{{$session->start_at->format('h:i A')}}</div>
    @if ($session->venue)
      <div>{{$session->venue}}</div>
    @endif
  </td>
  <td>
    <form action="/invite/response" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="session_id" value="{{$session->id}}">
    <input type="hidden" name="soul_id" value="{{$soul->id}}">
    <div class="ui mini buttons">
      <button type='submit' name='action' value="1" class="ui teal button">YES</button>
      <button type='submit' name='action' value="0" class="ui pink button">no</button>
    </div>
    </form>
  </td>
</tr>
@endif
@empty
  <tr>
    <td>
      No events? impossible. come back later.
    </td>
  </tr>
@endforelse
</table>

@endsection
