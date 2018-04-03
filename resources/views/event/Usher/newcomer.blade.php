@extends('event.usher.layout')

@section('title')
  {{ trans('event.usher.newcomer_list') }}
@endsection

@include('event.Usher.parts.navigation_bar')

@section('content')

<div>Welcome "Pastor Gin"</div>

<table class="ui celled striped table">
  <thead>
    <tr>
      <th colspan="3">
        Newcomer List (1)
      </th>
    </tr>
  </thead>
  @foreach ($random as $newcomer)
  <tbody>
    <tr>
      <td>
        <button class="ui button yellow create_btn jsbutton" type="button" id="nc{{$newcomer['id']}}">{{$newcomer['name']}}</button>
        <div class="ui modal" id="modal-of-nc{{$newcomer['id']}}">
          <i class="close icon"></i>
          <div class="header">
            Profile Picture
          </div>
          <div class="image content">
            <div class="ui medium image">
              <img src="https://semantic-ui.com/images/avatar2/large/rachel.png">
            </div>
            <div class="description">
              <h2>{{$newcomer['name']}}</h2>
              <div>{{$newcomer['phone']}}</div>
              <div>{{$newcomer['inviter']}}</div>
              <div>{{$newcomer['birthday']}}</div>
              <div>{{$newcomer['christian']}}</div>
              <div>{{$newcomer['FBID']}}</div>
              <div class="ui form">
                <div class="field">
                  <label class="mt-2">{{ trans('event.usher.assigned_people') }}</label>
                  <select class="ui dropdown">
                    <option>Joseph</option>
                    <option>Yong Jun</option>
                    <option>Leru</option>
                    <option>Cindy</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="actions">
            <div class="ui positive right labeled icon button">
              Save
              <i class="checkmark icon"></i>
            </div>
          </div>
{{--         <div>{{ trans('event.usher.assigned_cg') }}</div>
        <div class="ui two column centered grid">
        <select name="Assigned follow up ppl" class="column center aligned">
            <option value="E1">E1</option>
            <option value="E2">E2</option>
            <option value="E3">E3</option>
            <option value="S1">S1</option>
            <option value="W1">W1</option>
        </select> --}}
      </td>
      <td class="right aligned collapsing">10 hours ago</td>
    </tr>
  </tbody>
  @endforeach
</table>

@endsection

