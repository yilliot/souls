@extends('admin.layout.base')
@section('title')
Services
@endsection
@section('content')
<a href="/admin/service/create" class="ui teal button right floated">New service</a>
<h1 class="ui header">Services</h1>
<div class="ui segment">
  {!! Form::open(['url' => url()->current(), 'class' => 'ui form', 'method' => 'GET']) !!}
    {!! Form::select('type', [], null, ['class' => 'ui dropdown']) !!}
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
        <td> {{$service->title}} </td>
        <td> {{$service->pastor}} </td>
        <td> {{$service->at->format('M d')}} </td>
        <td>  {{$service->at->format('h:i a')}} </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/office/service/{{$service->id}}" class="ui teal button">
              <i class="eye icon"></i>
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
