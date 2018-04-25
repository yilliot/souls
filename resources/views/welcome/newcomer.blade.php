@extends('welcome.layout')

@section('title')
  {{ trans('welcome.newcomer_list') }}
@endsection

{{-- @include('welcome.parts.navigation_bar') --}}

@section('content')

<div>Welcome "Pastor Gin"</div>

<table class="ui unstackable table">
  <thead>
    <tr>
      <th>{{ trans('welcome.newcomer_list') }} (5)</th>
      <th class="right aligned">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($newcomerdetails as $newcomerdetail)
    <tr>
      <td>
        <button class="ui secondary button jsbutton" type="button" id="nc{{$newcomerdetail['id']}}">{{$newcomerdetail['name']}}</button>
      
        <div class="ui modal" id="modal-of-nc{{$newcomerdetail['id']}}">
          <i class="close icon"></i>
          <div class="header">
            Profile Picture
          </div>
          <div class="image content">
            <div class="description">
              <h2>{{$newcomerdetail['name']}}</h2>
              <table class="ui table">
                <tbody>
                  <tr>
                    <td>{{ trans('welcome.phone_number') }}</td>
                    <td>{{$newcomerdetail['phone']}}</td>
                  </tr>
                  <tr>
                    <td>{{ trans('welcome.inviter') }}</td>
                    <td>{{$newcomerdetail['inviter']}}</td>
                  </tr>
                  <tr>
                    <td>{{ trans('welcome.birthday') }}</td>
                    <td>{{$newcomerdetail['birthday']}}</td>
                  </tr>
                  <tr>
                    <td>{{ trans('welcome.christian') }}</td>
                    <td>{{$newcomerdetail['christian']}}</td>
                  </tr>
                  <tr>
                    <td>{{ trans('welcome.fbid') }}</td>
                    <td>{{$newcomerdetail['FBID']}}</td>
                  </tr>
                 <tr>
                    <td>{{ trans('welcome.about_me') }}</td>
                    <td style="width: 40em; word-break: break-all !important;">{{$newcomerdetail['description']}}</td>
                  </tr>
                </tbody>
              </table>
              {!! Form::open(['url' => '/event/pastoral/newcomer/post', 'method' => 'POST', 'autocomplete' => 'off']) !!}
              <div class="ui form">
                <div class="field">
                  <label class="mt-2">{{ trans('welcome.assigned_people') }}</label>
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
              {{ trans('welcome.submit') }}
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

