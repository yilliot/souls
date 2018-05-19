@extends('welcome.layout')

@section('title')
  Welcome Followup
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<h4> Followup list (3)</h4>

<table class="ui unstackable table mt-4">
  <thead>
    <tr>
      <th> No </th>
      <th> Name </th>
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
        <a class="ui small black icon button" href="/followup/profile/{{$newcomerdetail['id']}}">
          <i class="eye icon"></i>
        </a>
        <a class="ui small icon button" href="/followup/assign-cell-group/{{$newcomerdetail['id']}}">
          <i class="users icon"></i>
        </a>
        <a class="ui small black icon button" href="/followup/comment/{{$newcomerdetail['id']}}">
          <i class="comment outline icon"></i>
        </a>
        <a class="ui small icon button" href="/followup/comment-history/{{$newcomerdetail['id']}}">
          <i class="comment outline icon"></i>
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

