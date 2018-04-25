@extends('welcome.layout')

@section('title')
  followup
@endsection

{{-- @include('welcome.parts.navigation_bar') --}}

@section('content')

<div>Welcome "{{$followuplists[0]['name']}}"</div>

<table class="ui unstackable table mt-4">
  <thead>
    <tr>
      <th colspan="3">
        Followup list (2)
      </th>
    </tr>
  </thead>
  @forelse ($newcomerdetails as $newcomerdetail)
  @if ($newcomerdetail['assign'] == 2)
  <tbody>
    <tr>
      <td>
        <button class="ui secondary button jsbutton" type="button" id="nc{{$newcomerdetail['id']}}">{{$newcomerdetail['name']}}</button>      
        <div class="ui modal" id="modal-of-nc{{$newcomerdetail['id']}}">
          <i class="close icon"></i>
          <div class="header">
            Profile Picture
          </div>

          {{-- form layout structure --}}

          <div class="image content">
            <div class="description">

              {{-- profile picture --}}

              <h2>{{$newcomerdetail['name']}}</h2>
              <table class="ui table">
                <tbody>
                  <tr>
                    <td>{{ trans('welcome.welcome.phone_number') }}</td>
                    <td>{{$newcomerdetail['phone']}}</td>
                  </tr>
                  <tr>
                    <td>{{ trans('welcome.welcome.inviter') }}</td>
                    <td>{{$newcomerdetail['inviter']}}</td>
                  </tr>
                  <tr>
                    <td>{{ trans('welcome.welcome.birthday') }}</td>
                    <td>{{$newcomerdetail['birthday']}}</td>
                  </tr>
                  <tr>
                    <td>{{ trans('welcome.welcome.christian') }}</td>
                    <td>{{$newcomerdetail['christian']}}</td>
                  </tr>
                  <tr>
                    <td>{{ trans('welcome.welcome.fbid') }}</td>
                    <td>{{$newcomerdetail['FBID']}}</td>
                  </tr>
                  <tr>
                    <td>{{ trans('welcome.welcome.about_me') }}</td>
                    <td style="width: 40em; word-break: break-all !important;">{{$newcomerdetail['description']}}</td>
                  </tr>
                </tbody>
              </table>
              
              {{-- end of profile picture --}}

              {{-- assigned cell group --}}

              {!! Form::open(['url' => '/event/pastoral/newcomer/post', 'method' => 'POST', 'autocomplete' => 'off']) !!}
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
                  <tr class="content" style="display: flex !important; justify-content: space-between !important;">
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
                      <p class="width-md-comment-history width-lg-comment-history" style="word-break: break-word; white-space: pre-line;">Awesome, thats all. Recommend him 5 star. 32 likes, 64 likes, 92 likes. ahhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</p>
                    </td>
                  </tr>
                </tbody>
              </table>              
              
              {{-- end of comment history --}}

            </div>
          </div>
          
          {{-- end of form layout structure --}}

        </div>
      </td>
      <td style="float: right;">
        <div>1 comment history</div>
        <div>2 assigned cell group</div>
        <div>3 comment </div>  
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