@extends('admin.layout')
@section('title')
Service details
@endsection
@section('content')

<a class="ui large header" href="{{url()->previous()}}" ><i class="arrow left icon"></i>Service Detail</a>

<a href="/admin/service/{{$service->id}}/edit" class="ui icon blue right floated button">
  <i class="pencil icon"></i>
  edit
</a>

<div class="ui stackable column grid">
  <div class="five wide column">
    <div class="ui fluid card">
      <div class="content">
        <div>{{ $service->at->toDateString() }}</div>

        <div> <i class="eye icon"></i> {{ $service->forecast_size }}</div>
        <div> <i class="user group icon"></i> {{ $service->attendance_size }}</div>

        <div>{{ prefix()->wrap($service) }}</div>
        <div>{{ $service->speaker }}</div>
        <div>{{ $service->venue }}</div>
        <div>{{ $service->type }}</div>
      </div>
    </div>
  </div>
  <div class="eleven wide column">
  </div>
</div>
@endsection
