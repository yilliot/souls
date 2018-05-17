@extends('welcome.layout')

@section('title')
  Welcome Followup
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<h3>Welcome "{{$followuplists[0]['name']}}"</h3>

<table class="ui unstackable table mt-4">
  <thead>
    <tr>
      <th>
        Followup list (3)
      </th>
      <th>
      </th>
    </tr>
  </thead>
  @forelse ($newcomerdetails as $newcomerdetail)
  @if ($newcomerdetail['assign'] == 2)
  <tbody>
    <tr>
      <td>
        <div>{{$newcomerdetail['nickname']}}</div>    
        <div class="ui modal" id="modal-of-nc{{$newcomerdetail['id']}}">
          <i class="close icon"></i>
          <div class="header">
            Profile Picture
          </div>

          {{-- form layout structure --}}

          <div class="image content">
            <div class="description">

              {{-- profile picture --}}

              <h2>{{$newcomerdetail['nickname']}}</h2>
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
              
            </div>
          </div>
          
        </div>
              
        {{-- end of profile picture --}}

        {{-- assigned cell group --}}

        {!! Form::open(['url' => '/event/pastoral/newcomer/post', 'method' => 'POST', 'autocomplete' => 'off']) !!}
          <div class="ui modal p-4" id="modal-of-assigned-cell-group-nc{{$newcomerdetail['id']}}">
            <div class="ui form">
              <div class="field">
                <label class="mt-2">Assigned Cell Group</label>
                <select class="ui dropdown">
                  <option>E1</option>
                  <option>E2</option>
                  <option>E3</option>
                  <option>S1</option>
                  <option>W1</option>
                </select>
              </div>
            </div>
            <div class="actions">
              <button type="submit" class="ui positive right labeled icon button mb-3">
                {{ trans('welcome.welcome.submit') }}
                <i class="checkmark icon"></i>
              </button>
            </div>
          </div>
        {!! Form::close() !!}
              
        {{-- end of assigned cell group --}}

        {{-- comment --}}

        <div class="ui modal p-4" id="modal-of-comment-nc{{$newcomerdetail['id']}}">
          {!! Form::open(['url' => '/event/pastoral/newcomer/post', 'method' => 'POST', 'autocomplete' => 'off']) !!}
          <div class="ui form">
            <div class="field">
              <label class="mt-1">Comment</label>
              <textarea class="mb-3"></textarea>
            </div>
          </div>

          <div class="actions">
            <button type="submit" class="ui positive right labeled icon button mb-3">
              {{ trans('welcome.welcome.submit') }}
              <i class="checkmark icon"></i>
            </button>
          </div>
          {!! Form::close() !!}
              
          {{-- end of comment --}}

          {{-- comment history --}}

          <table class="ui table">
            <thead>
              <tr class="content p-2" style="display: flex !important; justify-content: space-between !important;">
                <th class="header w-100">
                  Comment History (1)
                </th>
                <th class="meta">
                  10 hours ago
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="mt-2">
                  <p class="width-md-comment-history width-lg-comment-history" style="word-break: break-word; white-space: pre-line;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, ad odio! Eos distinctio possimus nihil omnis amet quis labore, magnam minima eaque dicta, optio error pariatur eius, quisquam, eveniet deleniti?</p>
                </td>
              </tr>
            </tbody>
          </table>        

          {{-- end of comment history --}}

        </div>             
          
        {{-- end of form layout structure --}}

      </td>

      <td class="p-2" style="float: right;">
        <div id="nc{{$newcomerdetail['id']}}" class="button-click">1 profile picture</div>
        <div id="assigned-cell-group-nc{{$newcomerdetail['id']}}" class="button-click">2 assigned cell group</div>
        <div id="comment-nc{{$newcomerdetail['id']}}" class="button-click"> 3 comment </div>  
      </td>

    </tr>
  </tbody>
  @endif
  @empty
    <tr>
      <td>
        <div>Sorry u have not followup any people yet.</div>
      </td>
    </tr>
  @endforelse
</table>
@endsection