@extends('admin.layout')
@section('title')
Service forecast
@endsection
@section('content')

<a class="ui large header" href="/admin/service/{{$service->id}}" ><i class="arrow left icon"></i>Service forecast</a>
<div class="ui stackable column grid">
  <div class="five wide column">
    @include('admin.service.partial.service-card', ['service' => $service])

    <div class="ui fluid card">
      <div class="content">
        <h3 class="ui header">
          Coming members
          <div class="sub header">
            forecast total : {{$attendances->count()}}
          </div>
        </h3>

        <ol class="ordered list">
          @foreach ($attendances as $attendance)
            <li>
              {{$attendance->soul}}
              <button class="ui mini red icon button">
                <i class="remove icon"></i>
              </button>
            </li>
          @endforeach
        </ol>
      </div>
    </div>
  </div>
  <div class="eleven wide column">
    <table class="ui table">
      @foreach ($remaining_souls as $soul)
      <tr>
        <td>
          {{$soul}}
        </td>
        <td>
        </td>
        <td>
          <button class="ui green tiny icon button">
            <i class="add icon"></i>
          </button>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
