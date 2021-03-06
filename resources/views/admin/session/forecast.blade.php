@extends('admin.layout')
@section('title')
Service forecast
@endsection
@section('content')

<a class="ui large header" href="/admin/service/{{$service->id}}" ><i class="arrow left icon"></i>Service forecast</a>

<div class="ui hidden divider"></div>
<div class="ui stackable column grid">
  <div class="five wide column">
    @include('admin.service.partial.service-card', ['service' => $service])

    <div class="ui hidden divider"></div>
    <div class="ui divider"></div>

    <div class="ui fluid container">
      <h3 class="ui header">
        Coming members
        <div class="sub header">
          forecast total : {{$attendances->count()}} + {{$visitors->count()}}
        </div>
      </h3>
      <table class="ui unstackable compact small table">
        <thead>
          <tr>
            <th>No. </th>
            <th>Name</th>
            <th>Visitors</th>
            <th>Action</th>
          </tr>
        </thead>
      @forelse ($attendances as $index => $attendance)
        <tr>
          <td> {{$index+1}} </td>
          <td>
            <h4 class="ui header">
              {{$attendance->soul}}
              @forelse ($attendance->visitors as $visitor)
                <div class="sub header">{{$visitor}}</div>
              @empty
              @endforelse
            </h4>
          </td>
          <td class="centered aligned">
            <a href="/admin/attendance/{{$attendance->id}}/visitor/" class="ui mini icon pink basic button">
              {{$attendance->visitors->count()}}
              <i class="heartbeat icon"></i>
            </a>
          </td>
          <td>
            <button class="ui mini red icon button del modalcaller" data-modal-id="delete_attendance" data-attendance-id="{{$attendance->id}}" data-soul="{{$attendance->soul->nickname}}">
              <i class="remove icon"></i>
            </button>

          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4">No one yet?</td>
        </tr>
      @endforelse
      </table>
    </div>
  </div>
  <div class="eleven wide column">
    <h2 class="ui header">
      {{ $cellgroup }}, who else is coming?
    </h2>
    {!! Form::open(['url' => 'admin/attendance/add', 'class' => 'ui form']) !!}
    {!! Form::hidden('service_id', $service->id) !!}
    {!! Form::hidden('cellgroup_id', $cellgroup->id) !!}
    <table id='remaining_souls_table' class="ui unstackable selectable table">
      @forelse ($remaining_souls as $soul)
      <tr>
        <td>
          <h4 class="ui header">
            {{$soul}}
            <span class="sub inline uppercased header">
              ({{$soul->nric_fullname}})
            </span>
          </h4>
        </td>
        <td>
        </td>
        <td class="right aligned">
          <div class="ui checkbox">
            {!! Form::checkbox('souls[]', $soul->id) !!}
          </div>
        </td>
      </tr>
      @empty
      <thead>
        <tr>
          <th colspan="3" class="center aligned">
            Hoorray!
          </th>
        </tr>
      </thead>
      @endforelse
      @if ($remaining_souls->count() > 0)
      <tfoot>
        <tr>
          <th colspan="3">
            <button class="ui fluid green icon button">
              <i class="add icon"></i>
              Add them to coming members
            </button>
          </th>
        </tr>
      </tfoot>
      @endif
    </table>
    {!! Form::close() !!}
  </div>
</div>


{!! Form::open(['url' => '/admin/attendance/delete/', 'class' => 'ui small delete_attendance modal']) !!}
  <input type="hidden" name="id" id="attendance_id">
  <input type="hidden" name="service_id" value="{{$service->id}}">
  <div class="header capitalized">
    Delete forecast
  </div>
  <div class="center aligned content">
    <p>Confirm delete forecast of this person - <b id="soul-nickname"> xxx </b>:</p>
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

@section('script')
<script>
  $('button.del.modalcaller').click(function(){
    $('#soul-nickname').text($(this).data('soul'));
    $('input#attendance_id').val($(this).data('attendance-id'));
  });
  $('#remaining_souls_table tr').click(function() {
    if ($(this).hasClass('positive')) {
      $(this).removeClass('positive');
      $(this).find('input[type=checkbox]').prop('checked', false);
    } else {
      $(this).addClass('positive');
      $(this).find('input[type=checkbox]').prop('checked', true);
    }
  })
</script>
@endsection
