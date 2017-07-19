@extends('admin.layout')
@section('title')
Service visitor
@endsection
@section('content')

<a class="ui large header" href="/admin/service/{{$attendance->service->id}}/attendance?cellgroup={{$attendance->cellgroup_id}}" ><i class="arrow left icon"></i>Service visitor</a>

<div class="ui hidden divider"></div>
<div class="ui stackable column grid">
  <div class="five wide column">
    @include('admin.service.partial.service-card', ['service' => $attendance->service])

    <div class="ui hidden divider"></div>
    <div class="ui divider"></div>

    <div class="ui fluid container">
      <h3 class="ui header">
        Visitors invited by {{$attendance->soul}}
        <div class="sub header">
          visitor total : {{$attendance->visitors->count()}}
        </div>
      </h3>
      <table class="ui basic compact table">
        @forelse($attendance->visitors as $index => $visitor)
        <tr>
          <td>{{$index+1}}</td>
          <td>{{$visitor}}</td>
          <td>
            <button class="ui mini red icon button del modalcaller" data-modal-id="delete_visitor" data-visitor-id="{{$visitor->id}}" data-visitor="{{$visitor->name}}">
              <i class="remove icon"></i>
            </button>
          </td>
        </tr>
        @empty
        @endforelse
      </table>
    </div>
  </div>
  <div class="eleven wide column">
    <h2 class="ui header">
      {{ $attendance->soul->nickname }}, who else are you bringing?
    </h2>
    {!! Form::open(['url' => 'admin/attendance/visitor', 'class' => 'ui form']) !!}
    {!! Form::hidden('service_id', $attendance->service->id) !!}
    {!! Form::hidden('attendance_id', $attendance->id) !!}
    {!! Form::hidden('cellgroup_id', $attendance->cellgroup->id) !!}
    {!! Form::hidden('soul_id', $attendance->soul->id) !!}
    <table class="ui table">
    @for ($i = 0; $i < 5; $i++)
      <tr>
        <td> {{ $i+1 }}. </td>
        <td>
          {!! Form::text('visitor[]', null, ['placeholder'=>'what is his/her name']) !!}
        </td>
      </tr>
    @endfor
      <tfoot>
        <tr>
          <th colspan="3">
            <button class="ui right floated green icon button">
              <i class="add icon"></i>
              Add them to coming members
            </button>
          </th>
        </tr>
      </tfoot>
    </table>
    {!! Form::close() !!}
  </div>
</div>


{!! Form::open(['url' => '/admin/attendance/visitor', 'class' => 'ui small delete_visitor modal']) !!}
  {{ method_field('DELETE') }}
  <input type="hidden" name="id" id="visitor_id">
  <div class="header capitalized">
    Delete visitor
  </div>
  <div class="center aligned content">
    <p>Confirm delete visit of this person - <b id="visitor-nickname"> xxx </b>:</p>
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
    $('#visitor-nickname').text($(this).data('visitor'));
    $('input#visitor_id').val($(this).data('visitor-id'));
  });
</script>
@endsection
