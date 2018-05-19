@extends('welcome.layout')

@section('title')
  Welcome Newcomer
@endsection

@include('welcome.parts.navigation_bar')

@section('content')


<h4> {{ trans('welcome.welcome.newcomer_list') }} (5)</h4>

<table class="ui unstackable table mt-4">
  <thead>
    <tr>
      <th> No </th>
      <th> Name </th>
      <th class="right aligned">Action</th>
    </tr>
  </thead>


  @forelse ($newcomerdetails as $newcomerdetail)
  <tbody>
    <tr>
      <td>
        <div>{{$newcomerdetail['id']}}</div>       
      </td>
      <td>
        <div>{{$newcomerdetail['nickname']}}</div>
      </td>
      <td class="right aligned">
          <a class="ui small black icon button" href="/pastoral/newcomer/profile/{{$newcomerdetail['id']}}">
            <i class="eye icon"></i>
          </a>
          <a class="ui small icon button" href="/pastoral/newcomer/assign-people/{{$newcomerdetail['id']}}">
            <i class="write icon"></i>
          </a>
      </td>
    </tr>
  </tbody>
  @empty
  <tbody>
    <tr>
      <td>
        No services, change filter or come back later
      </td>
    </tr>
  </tbody>
  @endforelse
</table>

@endsection

