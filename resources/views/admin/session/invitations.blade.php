@extends('admin.layout')
@section('title')
Forecast / Attendance
@endsection
@section('content')

<h1 class="ui header">Session Forecast / Attendance</h1>

<div class="ui grid">
  <div class="seven wide column">
    <div class="ui horizontal divider"> Session Info </div>

    <table class="ui unstackable table">
      @if ($session->cg_id)
        <tr>
          <td class="right aligned">Type</td>
          <td>
            {{$session->type}}
            ({{\App\Models\CG::find($session->cg_id)->name}})
          </td>
        </tr>
      @endif
      @if ($session->title)
        <tr>
          <td class="right aligned"><b>Title</b></td>
          <td>
            {{$session->title}} <br>
          </td>
        </tr>
      @endif
      @if ($session->speaker)
        <tr>
          <td class="right aligned"><b>Speaker/Host</b></td>
          <td> {{$session->speaker}} </td>
        </tr>
      @endif
      @if ($session->venue)
        <tr>
          <td class="right aligned"><b>Venue</b></td>
          <td> {{$session->venue}} </td>
        </tr>
      @endif
    </table>
  </div>
  <div class="nine wide column">
    <div class="ui horizontal divider"> Forecast / Attendance Info </div>
    <table class="ui unstackable compact table">
      <tr>
        <td class="center aligned">forecast</td>
        <td class="center aligned">attendance</td>
      </tr>
      <tr>
        <td class="center aligned">{{$session->forecast_size}}</td>
        <td class="center aligned">{{$session->attendance_size}}</td>
      </tr>
    </table>
  </div>
</div>


<div class="ui horizontal divider">{{$session->title}}'s <br> Guest List </div>

<div class="ui segment">
  <div class="ui tiny group buttons">
    @foreach (\App\Models\Group::all() as $group)
      <a href="{{request()->fullUrlWithQuery(['group_id' => $group->id])}}" class="ui button"> {{$group->name}} </a>
    @endforeach
  </div>

    <div class="clearfix field">
      <a href="{{ url()->current() }}" class="ui basic right floated right labeled icon tiny button">
        Reset <i class="undo icon"></i>
      </a>
      <button class="ui teal right floated right labeled icon tiny button">
        Filter <i class="filter icon"></i>
      </button>
    </div>
    <div class="ui hidden divider"></div>
  {!! Form::close() !!}
</div>
<table class="ui very compact table">
  <thead>
    <tr>
      <th class="three wide">Soul</th>
      <th >Status</th>
      <th >Created at</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($invitations as $invitation)
      <tr class="{{ $invitation->is_coming ? 'positive' : '' }}">
        <td>
          @if ($invitation->soul)
            {{ $invitation->soul }}
          @endif
        </td>
        <td >
          @if ($invitation->is_attended)
            <span class="ui mini black label">attended</span>
          @elseif ($invitation->is_coming === 0)
            <span class="ui mini red label">is not coming</span>
          @elseif ($invitation->is_coming === 1)
            <span class="ui mini green label">is coming</span>
          @endif
        </td>
        <td>
          {{ $invitation->created_at->format('Y-m-d') }}
          <div>{{ $invitation->created_at->format('h:i a') }}</div>
        </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/admin/invitation/{{$invitation->id}}" class="ui button">
              <i class="pencil icon"></i>
            </a>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5"> No invitation record yet, change filter or come back later </td>
      </tr>
    @endforelse
  </tbody>
</table>
@endsection
