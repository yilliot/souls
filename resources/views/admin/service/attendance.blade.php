@extends('admin.layout')
@section('title')
Service attendance
@endsection
@section('content')

<a class="ui large header" href="/admin/service/{{$service->id}}" ><i class="arrow left icon"></i>Service attendance</a>

<div class="ui hidden divider"></div>

<div class="ui stackable column grid">

  <div class="five wide column">
    @include('admin.service.partial.service-card', ['service' => $service])
    <div class="ui hidden divider"></div>
    <div class="ui divider"></div>
    <h3 class="ui icon heading">
      <i class="checkmark icon"></i>
      Attended
      ({{$attendances->where('is_attended', true)->count()}}
      + {{$visitors->where('is_attended', true)->count()}})
    </h3>
    <table class="ui unstackable compact small table">
      @forelse ($visitors->where('is_attended', true) as $visitor)
      <tr>
        <td>
          <h4 class="ui icon heading">
            <i class="yellow star icon"></i>
            {{$visitor->name}}
            <div class="sub header">
              by {{$visitor->soul->nickname}}
            </div>
          </h4>
        </td>
        <td class="right aligned">
          <button class="ui mini red icon button del modalcaller" data-modal-id="reset_attendance" data-id="{{$visitor->id}}" data-name="{{$visitor->name}}" data-type='visitor'>
            <i class="remove icon"></i>
          </button>
        </td>
      </tr>
      @empty
        <tr>
          <td colspan="2">No visitors yet</td>
        </tr>
      @endforelse

      @forelse ($attendances->where('is_attended', true) as $attendance)
      <tr>
        <td>
          <h4 class="ui header">
            {{$attendance->soul->nickname}}
          </h4>
        </td>
        <td class="right aligned">
        <button class="ui mini red icon button del modalcaller" data-modal-id="reset_attendance" data-id="{{$attendance->id}}" data-name="{{$attendance->soul->nickname}}" data-type='attendance'>
          <i class="remove icon"></i>
        </button>
        </td>
      </tr>
      @empty
        <tr>
          <td colspan="2">Is anyone there?</td>
        </tr>
      @endforelse
    </table>

  </div>


  <div id="waiting-column" class="eleven wide column">
    <h3 class="ui icon heading">
      <i class="clock icon"></i>
      Waiting ({{$attendances->where('is_attended', null)->count()}}
      + {{$visitors->where('is_attended', null)->count()}})
    </h3>
    {!! Form::open(['url' => 'admin/attendance/attended', 'class' => 'ui form']) !!}
    {!! Form::hidden('service_id', $service->id) !!}
    {!! Form::hidden('cellgroup_id', $cellgroup->id) !!}
    <h4 class="ui header">Visitors</h4>
    <table class="ui unstackable compact small table  checkable-table">
      @forelse ($visitors->where('is_attended', null) as $visitor)
      <tr>
        <td>
          <h4 class="ui header">
            {{$visitor->name}}
            <div class="sub inline header">
              by {{$visitor->soul->nickname}}
            </div>
          </h4>
        </td>
        <td class="right aligned">
          <div class="ui checkbox">
            {!! Form::checkbox('visitor[]', $visitor->id) !!}
          </div>
        </td>
      </tr>
      @empty
        <tr>
          <td colspan="2">Horray!</td>
        </tr>
      @endforelse
    </table>

    <table class="ui unstackable compact small table checkable-table">
      @forelse ($attendances->where('is_attended', null) as $attendance)
      <tr>
        <td>
          <h4 class="ui header">
            {{$attendance->soul->nickname}}
            <div class="sub inline header">
              ({{$attendance->soul->nric_fullname}})
            </div>

          </h4>
        </td>
        <td class="right aligned">
          <div class="ui checkbox">
            {!! Form::checkbox('attendance[]', $attendance->id) !!}
          </div>
        </td>
      </tr>
      @empty
        <tr>
          <td colspan="2">Horray!</td>
        </tr>
      @endforelse

      @if ($attendances->where('is_attended', false)->count() > 0)
      <tfoot>
        <tr>
          <th colspan="3">
            <button class="ui fluid green icon button">
              <i class="add icon"></i>
              Add them to attended
            </button>
          </th>
        </tr>
      </tfoot>
      @endif
    </table>
    {!! Form::close() !!}

  </div> {{-- waiting-column --}}
</div>

{!! Form::open(['url' => '/admin/attendance/reset/', 'class' => 'ui small reset_attendance modal']) !!}
  <input type="hidden" name="id" id="attendance-id">
  <input type="hidden" name="type" id="attendance-type" value="">
  <input type="hidden" name="service_id" value="{{$service->id}}">
  <div class="header capitalized">
    Reset attendance
  </div>
  <div class="center aligned content">
    <p>Confirm reset attendance of this person - <b id="attendance-name"> xxx </b>:</p>
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
    $('#attendance-name').text($(this).data('name'));
    $('input#attendance-id').val($(this).data('id'));
    $('input#attendance-type').val($(this).data('type'));
  });
  $('.checkable-table tr').click(function() {
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