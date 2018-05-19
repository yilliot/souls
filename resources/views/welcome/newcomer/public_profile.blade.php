@extends('welcome.layout')

@section('title')
  Public Profile
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

{{-- profile picture detail --}}

  <h3> Public Profile </h3>
  <table class="ui table">
    <thead>
      <tr>
        <th> {{$newcomerdetail['nickname']}} </th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Nickname</td>
        <td>{{$newcomerdetail['nickname']}}</td>
      </tr>
      <tr>
        <td>NRIC</td>
        <td>{{$newcomerdetail['nric']}}</td>
      </tr>
      <tr>
        <td>NRIC Full Name</td>
        <td>{{$newcomerdetail['nric_fullname']}}</td>
      </tr>
      <tr>
        <td>{{ trans('welcome.welcome.birthday') }}</td>
        <td>{{$newcomerdetail['birthday']}}</td>
      </tr>
      <tr>
        <td>Email</td>
        <td>{{$newcomerdetail['email']}}</td>
      </tr>
      <tr>
        <td>Contact 1</td>
        <td>{{$newcomerdetail['contact']}}</td>
      </tr>
      <tr>
        <td>Contact 2</td>
        <td>{{$newcomerdetail['contact2']}}</td>
      </tr>
      <tr>
        <td>Address 1</td>
        <td style="width: 40em;">{{$newcomerdetail['address']}}</td>
      </tr>
      <tr>
        <td>Address 2</td>
        <td style="width: 40em;">{{$newcomerdetail['address2']}}</td>
      </tr>
      <tr>
        <td>First time come to chruch?</td>
        <td style="width: 40em;">{{$newcomerdetail['new_comer']}}</td>
      </tr>
    </tbody>
  </table>
  

  <div style="display: flex; justify-content: center;">
    <a role="button" href="/pastoral/newcomer/" class="ui black deny button mb-5">
      OK
    </a>
  </div>

{{-- end of profile picture detail --}}

@endsection

