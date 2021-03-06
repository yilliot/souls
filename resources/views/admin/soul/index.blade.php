@extends('admin.layout')
@section('title')
Souls
@endsection
@section('content')
<a href="/admin/soul/create" class="ui teal button right floated">New soul</a>
<h1 class="ui header">Souls</h1>
<div class="ui segment">
  {!! Form::open(['url' => url()->current(), 'class' => 'ui form', 'method' => 'GET']) !!}
    <div class="ui tiny group buttons">
      @foreach ($groups as $group)
        <a href="{{$request->fullUrlWithQuery(['group_id' => $group->id])}}" class="ui button"> {{$group->name}} </a>
      @endforeach
    </div>
    status :
    {!! Form::select('is_active', ['0' => 'Not active', '1' => 'Active', 'all' => 'All'], $filter['is_active'], ['class' => 'ui dropdown']) !!}
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
<table class="ui very compact table">
  <thead>
    <tr>
      <th >{!! sort_by('id', 'ID' ) !!}</th>
      <th  class="three wide">Name</th>
      <th >Group</th>
      <th >Status</th>
      <th >Created at</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($souls as $soul)
      <tr>
        <td>
          {{ prefix()->wrap($soul) }}
        </td>
        <td>
          <h5 class="ui header">
            {{ $soul->nickname }}
            <div class="sub uppercased header">{{ $soul->nric_fullname }}</div>
          </h5>
        </td>
        <td >
          @foreach ($soul->groups as $group)
            <span class="ui label">{{ $group->name }}</span>
          @endforeach
        </td>
        <td>
          <div>
            @if ($soul->is_active)
              <div class="ui green label">active</div>
            @else
              <div class="ui grey label">not active</div>
            @endif
          </div>
          <div>
            @if ($soul->baptism_serial)
              <div class="ui icon teal label">
                <i class="theme icon"></i>
                {{$soul->baptism_serial}}
              </div>
            @endif
          </div>
        </td>
        <td>
          {{ $soul->created_at->format('Y-m-d') }}
        </td>
        <td>
          <div class="ui small icon buttons">
            <a href="/admin/soul/{{$soul->id}}/edit" class="ui teal button">
              <i class="edit icon"></i>
            </a>
            <a href="/admin/soul/{{$soul->id}}" class="ui button">
              <i class="eye icon"></i>
            </a>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5"> No souls, change filter or come back later </td>
      </tr>
    @endforelse
  </tbody>
</table>
{{ $souls->appends($filter)->links() }}
@endsection
