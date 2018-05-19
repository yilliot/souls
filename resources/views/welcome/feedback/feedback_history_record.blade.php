@extends('welcome.layout')

@section('title')
  Chatbook Record History
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<h4> Chatbook Record History (3) </h4>

<table class="ui unstackable table mt-4">
  <thead>
    <tr>
      <th> No </th>
      <th> Name </th>
      <th class="right aligned"> Date </th>
      <th class="right aligned">Action</th>
    </tr>
  </thead>

  @forelse ($newcomerdetails as $newcomerdetail)
  @if ($newcomerdetail['assign'] == 2)

  <tbody>
    <tr>
      <td>
        <div>{{$newcomerdetail['id']}}</div>       
      </td>
      <td>
        <div>{{$newcomerdetail['nickname']}}</div>
      </td>
      <td class="right aligned">
        2017-05-29 13:51:54
      </td>
      <td class="right aligned">
        <a class="ui small black icon button" href="/welcome/feedback/history/">
          <i class="eye icon"></i>
        </a>
      </td>
    </tr>
  </tbody>
  @endif
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