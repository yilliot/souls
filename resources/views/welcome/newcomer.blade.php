@extends('welcome.layout')

@section('title')
  Welcome Newcomer
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<h3>Welcome "Pastor Gin"</h3>

<table class="ui unstackable table">
  <thead>
    <tr>
      <th>{{ trans('welcome.welcome.newcomer_list') }} (5)</th>
      <th class="right aligned">Action</th>
    </tr>
  </thead>
  @forelse ($newcomerdetails as $newcomerdetail)
  <tbody>
    <tr>
      <td>
        <div>{{$newcomerdetail['nickname']}}</div>
      
        {{-- Profile piicture --}}

        <div class="ui modal" id="modal-of-edit-nc{{$newcomerdetail['id']}}">
          <i class="close icon"></i>
          <div class="header">Profile Picture</div>
          <div class="image content">
            <div class="description">
              <h2>{{$newcomerdetail['nickname']}}</h2>

              {{-- profile picture detail --}}

              <table class="ui table">
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
              <button type="submit" class="ui teal button mt-2 mb-1">
                OK
              </button>
              </div>

              {{-- end of profile picture detail --}}

            </div>
          </div>
        </div>

        {{-- end of profile picture --}}

        {{-- cell group assign --}}

        <div class="ui modal p-3" id="modal-of-view-nc{{$newcomerdetail['id']}}">

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

          {!! Form::open(['url' => '/event/pastoral/newcomer/post', 'method' => 'POST', 'autocomplete' => 'off']) !!}
            <div class="actions">
              <button type="submit" class="ui right floated green labeled icon button mt-3 mb-3">
                {{ trans('welcome.welcome.submit') }}
                <i class="checkmark icon"></i>
              </button>
            </div>
          {!! Form::close() !!}

        </div>

        {{-- end of cell group assign --}}

      </td>

      {{-- option "assign cell group" "profile picture detail" --}}

      <td class="right aligned">
        <div class="ui small icon buttons">
          <a class="ui grey button button-click" id="edit-nc{{$newcomerdetail['id']}}">
            <i class="eye icon"></i>
          </a>
          <a class="ui button button-click" id="view-nc{{$newcomerdetail['id']}}">
            <i class="write icon"></i>
          </a>
        </div>
      </td>

      {{-- end of option "assign cell group" "profile picture detail" --}}

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

