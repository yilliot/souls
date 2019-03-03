@extends('admin.layout')
@section('title')
Invitation
@endsection
@section('content')

<h1 class="ui header">Session Invitation</h1>

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
      <tr>
        <td class="right aligned"><b>Invitation</b></td>
        <td>
          @if ($session->forecast_size)
            {{$session->attendance_size}} / {{$session->forecast_size}} ({{number_format($session->attendance_size / $session->forecast_size * 100)}} %) </td>
          @else
            -
          @endif
      </tr>
    </table>
  </div>
  <div class="nine wide column">
    <form method="POST">
        {{csrf_field()}}
    <div class="ui horizontal divider"> Invitation Action </div>
    @if (is_null($session->cg_id))
    @elseif ($session->is_church_wide)
      <div class="ui message">
        Church Wide's session, everyone is invited to this event.
      </div>
    @elseif ($session->cg_id)
      <div style="margin-bottom:5px">
        @forelse ($cgRemainSouls = \App\Models\Soul::where('cellgroup_id', $session->cg_id)->whereNotIn('id', $invitations->pluck('soul_id'))->get() as $soul)
          <div class="ui small basic label">{{$soul->nickname}}</div>
          <input type="hidden" name="souls[]" value="{{$soul->id}}">
        @empty
          Everyone in {{$session->cg}} is invited
        @endforelse
      </div>
      @if ($cgRemainSouls->count())
        <button type="submit" name="target" value="cg.{{$session->cg_id}}" class="ui fluid button">Send invitation to members</button>
      @endif
    @else
      <div class="ui horizontal divider"> CG </div>
        @foreach (\App\Models\CG::active()->get() as $cg)
          <button type="submit" name="target" value="cg.{{$cg->id}}" class="ui button">{{$cg->name}}</button>
        @endforeach
      <div class="ui horizontal divider"> Team </div>
    @endif
    </form>
  </div>
</div>


<div class="ui horizontal divider">{{$session->title}}'s <br> Guest List </div>

<div class="ui segment">
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
      <th >CG</th>
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
          @if ($invitation->cg)
            {{ $invitation->cg }}
          @endif
        </td>
        <td>
          @if ($invitation->soul)
            {{ $invitation->soul }}
          @endif
          @if ($invitation->visitor_name)
            {{ $invitation->visitor_name }}
          @endif
          @if ($invitation->invitor_id)
            {{ $invitation->invitor }}
          @endif
        </td>
        <td >
          @if ($invitation->is_attended)
            <span class="ui mini black label">attended</span>
          @elseif ($invitation->is_coming === 0)
            <span class="ui mini red label">is not coming</span>
          @elseif ($invitation->is_coming === 1)
            <span class="ui mini green label">is coming</span>
          @else
            <span class="ui mini label">invited</span>
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
