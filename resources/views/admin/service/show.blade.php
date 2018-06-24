@extends('admin.layout')
@section('title')
Service details
@endsection
@section('content')

<a class="ui large header" href="{{url()->previous()}}" ><i class="arrow left icon"></i>Service Detail</a>


<div class="ui hidden divider"></div>
<div class="ui stackable column grid">
  <div class="five wide column">
    @include('admin.service.partial.service-card', ['service' => $service])
    <a href="/admin/service/{{$service->id}}/edit" class="ui icon teal fluid button">
      <i class="pencil icon"></i>
      edit
    </a>

  </div>
  <div class="eleven wide column">
    <table class="ui striped unstackable compact table">
      <thead>
        <tr>
          <th>
            Cellgroup
          </th>
          <th>
            Forecast
          </th>
          <th>
            Attendance
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cellgroups as $cellgroup)
          <tr>
            <td> {{$cellgroup}} </td>
            <td> 0 </td>
            <td> 0 </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th> Total </th>
          <th> 0 </th>
          <th> 0 </th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@endsection
