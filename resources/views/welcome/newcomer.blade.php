@extends('welcome.layout')

@section('title')
  Welcome Newcomer
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<div>Welcome "Pastor Gin"</div>

<table class="ui unstackable table">
  <thead>
    <tr>
      <th>{{ trans('welcome.welcome.newcomer_list') }} (5)</th>
      <th class="right aligned">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($newcomerdetails as $newcomerdetail)
    <tr>
      <td>
        <button class="ui secondary button jsbutton" type="button" id="nc{{$newcomerdetail['id']}}">{{$newcomerdetail['nickname']}}</button>
      
        <div class="ui modal" id="modal-of-nc{{$newcomerdetail['id']}}">
          <i class="close icon"></i>
          <div class="header">
            Profile Picture
          </div>
          <div class="image content">
            <div class="description">
              <h2>{{$newcomerdetail['nickname']}}</h2>
              <table class="ui table">
                <tbody>
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
              {!! Form::open(['url' => '/event/pastoral/newcomer/post', 'method' => 'POST', 'autocomplete' => 'off']) !!}
              <div class="ui form">
                <div class="field">
                  <label class="mt-2">{{ trans('welcome.welcome.assigned_people') }}</label>
                  <select class="ui dropdown">
                    @foreach ($followuplists as $followuplist)
                      <option>{{$followuplist['name']}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="actions">
            <button type="submit" class="ui positive right labeled icon button mb-3">
              {{ trans('welcome.welcome.submit') }}
              <i class="checkmark icon"></i>
            </button>
          {!! Form::close() !!}
          </div>
        </div>
      </td>
      <td class="right aligned">
        <div class="ui small icon buttons">
          <a href="/office/user/" class="ui grey button">
            <i class="eye icon"></i>
          </a>
          <a href="/office/user/verify/" class="ui button">
            <i class="write icon"></i>
          </a>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection

