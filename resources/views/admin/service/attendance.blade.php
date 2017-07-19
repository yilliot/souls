@extends('admin.layout')
@section('title')
Service attendance
@endsection
@section('content')

<a class="ui large header" href="/admin/service/{{$service->id}}" ><i class="arrow left icon"></i>Service attendance</a>
<div class="ui stackable column grid">
  <div class="sixteen wide column">
    <table class="ui table">
      @foreach ($souls as $soul)
      <tr>
        <td>
          {{$soul}}
        </td>
        <td>
          <span class="ui green label">
            <i class="check icon"></i>
          </span>
        </td>
        <td>
          <button class="ui red tiny icon button modalcaller" data-modal-id="delete_attendance" data-attendance-id="{{$}}">
            <i class="remove icon"></i>
          </button>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

{!! Form::open(['url' => '/admin/attendance/delete/', 'class' => 'ui small delete_attendance modal']) !!}
  <input type="hidden" name="id" id="attendance_id">
  <div class="header capitalized">
    Delete forecast
  </div>
  <div class="center aligned content">
    <p>Confirm delete forecast of this person - <b> xxx </b>:</p>
  </div>
  <div class="actions">
    <button type="submit" class="ui negative right labeled icon button">
      Delete <i class="checkmark icon"></i>
    </button>
    <div class="ui cancel basic button">
      Cancel
    </div>
  </div>
{!! Form::close() !!}

@endsection
