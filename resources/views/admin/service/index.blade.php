@extends('admin.layout')
@section('title')
Services
@endsection
@section('content')
<a href="/admin/service/create" class="ui teal button right floated">New service</a>
<h1 class="ui header">Services</h1>
<div class="ui segment">
  {!! Form::open(['url' => url()->current(), 'class' => 'ui form', 'method' => 'GET']) !!}
    <div class="inline field">
      <label for="">From</label>
      <input type="date" name="onward" value="{{$filter['onward']}}">
      <label for="">Onward</label>
    </div>
    <div class="clearfix field">
      <a href="{{ url()->current() }}" class="ui basic right floated right labeled icon tiny button">
        Reset <i class="undo icon"></i>
      </a>
      <button class="ui teal right floated right labeled icon tiny button">
        Filter <i class="filter icon"></i>
      </button>
      <div class="ui hidden divider"></div>
      <div class="ui hidden divider"></div>
    </div>
  {!! Form::close() !!}
</div>
<table class="ui table">
  <thead>
    <tr>
      <th>Date</th>
      <th>Time</th>
      <th class="three wide">Topic</th>
      <th>Pastor</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  @forelse ($chunk_services as $key => $services)
    <thead>
      <tr>
        <th colspan="5" class="center aligned">
          {{$key}}
        </th>
      </tr>
    </thead>
    @foreach ($services as $service)
      <tr>
        <td> {{$service->at->format('M d')}} </td>
        <td>  {{$service->at->format('h:i a')}} </td>
        <td>
          <h4 class="ui header">
            {{$service->topic}}
            <div class="sub header">
              {{$service->type}}
            </div>
          </h4>
        </td>
        <td> {{$service->speaker}} </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/admin/service/{{$service->id}}/edit" class="ui teal button">
              <i class="edit icon"></i>
            </a>
            <a href="/admin/service/{{$service->id}}" class="ui button">
              <i class="eye icon"></i>
            </a>
          </div>
        </td>
      </tr>
    @endforeach
  @empty
    <tr>
      <td colspan="5"> No services, change filter or come back later </td>
    </tr>
  @endforelse
  </tbody>
</table>
{{ $page_services->links() }}
@endsection
