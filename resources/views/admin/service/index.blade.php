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
      <th>{!! sort_by('id', 'ID' ) !!}</th>
      <th class="three wide">Title</th>
      <th>Pastor</th>
      <th>Date</th>
      <th>Time</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($services as $service)
      <tr>
        <td> {{prefix()->wrap($service)}} </td>
        <td> {{$service->topic}} </td>
        <td> {{$service->speaker}} </td>
        <td> {{$service->at->format('M d')}} </td>
        <td>  {{$service->at->format('h:i a')}} </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/admin/service/{{$service->id}}" class="ui button">
              <i class="eye icon"></i>
            </a>
            <a href="/admin/service/{{$service->id}}/edit" class="ui teal button">
              <i class="edit icon"></i>
            </a>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5"> No services, change filter or come back later </td>
      </tr>
    @endforelse
  </tbody>
</table>
{{ $services->links() }}
@endsection
