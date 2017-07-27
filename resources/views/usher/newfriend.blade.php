@extends('member.layout')
@section('title')
{{trans('usher.newfriend.welcome')}}
@endsection
@section('content')
<div class="ui text container">
  <a href="/session/lang/zh">中文</a> |
  <a href="/session/lang/en">English</a>
  @include('parts.flash')
  {!! Form::open(['url' => '/usher/newfriend/', 'method' => 'POST', 'class' => 'ui form']) !!}
  <table class="ui structured table">
    <tr class="field {{$errors->has('nric') ? 'error' : ''}}">
      <td><b>{{trans('usher.newfriend.label.nric')}}</b></td>
      <td>
        {{ Form::text('nric', null, ['placeholder' => trans('field.nric')]) }}
        @if ($errors->has('nric'))
          <span class="ui red pointing label"> {{ $errors->first('nric') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('nric_fullname') ? 'error' : ''}}">
      <td><b>{{trans('usher.newfriend.label.nric_fullname')}}</b></td>
      <td>
        {{ Form::text('nric_fullname', null, ['placeholder' => trans('field.nric_fullname')]) }}
        @if ($errors->has('nric_fullname'))
          <span class="ui red pointing label"> {{ $errors->first('nric_fullname') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('nickname') ? 'error' : ''}}">
      <td>
        <b>{{trans('usher.newfriend.label.nickname')}}</b>
      </td>
      <td>
        {{ Form::text('nickname', null, ['placeholder' => trans('field.nickname')]) }}
        @if ($errors->has('nickname'))
          <span class="ui red pointing label"> {{ $errors->first('nickname') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('birthday') ? 'error' : ''}}">
      <td>
        <label for="birthday"><b>{{trans('usher.newfriend.label.birthday')}}</b></label>
      </td>
      <td class="twelve wide">
        <input type="date" name="birthday" placeholder="{{trans('field.birthday')}}" value="{{old('birthday')}}">
        @if ($errors->has('birthday'))
          <span class="ui red pointing label"> {{ $errors->first('birthday') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('email') ? 'error' : ''}}">
      <td><b>{{trans('usher.newfriend.label.email')}}</b></td>
      <td>
        <input type="email" name="email" value="{{old('email')}}" placeholder="{{trans('field.email')}}">
        @if ($errors->has('email'))
          <span class="ui red pointing label"> {{ $errors->first('email') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('contact') ? 'error' : ''}}">
      <td><b>{{trans('usher.newfriend.label.contact')}}</b></td>
      <td>
        <div class="ui labeled input">
          <i class="ui label">+</i>
          {{ Form::text('contact', null, ['placeholder' => trans('field.contact')]) }}
        </div>
        @if ($errors->has('contact'))
          <span class="ui red pointing label"> {{ $errors->first('contact') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('contact2') ? 'error' : ''}}">
      <td><b>{{trans('usher.newfriend.label.contact')}} 2</b></td>
      <td>
        <div class="ui labeled input">
          <i class="ui label">+</i>
          {{ Form::text('contact2', null, ['placeholder' => trans('field.contact')]) }}
        </div>
        @if ($errors->has('contact2'))
          <span class="ui red pointing label"> {{ $errors->first('contact2') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{ $errors->has('address1') || $errors->has('address2') || $errors->has('postal_code') ? 'error' : ''}}">
      <td><b>{{trans('usher.newfriend.label.address')}}</b></td>
      <td>
        <div class="field">{{ Form::text('address1', null, ['placeholder' => trans('field.address1')]) }}</div>
        @if ($errors->has('address1'))
          <span class="ui red pointing label"> {{ $errors->first('address1') }}</span>
        @endif
        <div class="field">{{ Form::text('address2', null, ['placeholder' => trans('field.address2')]) }}</div>
        @if ($errors->has('address2'))
          <span class="ui red pointing label"> {{ $errors->first('address2') }}</span>
        @endif
        <div class="field">{{ Form::text('postal_code', null, ['placeholder' => trans('field.postal_code')]) }}</div>
        @if ($errors->has('postal_code'))
          <span class="ui red pointing label"> {{ $errors->first('postal_code') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('cellgroup') ? 'error' : ''}}">
      <td>
        <b>{{trans('usher.newfriend.label.cellgroup')}}</b>
      </td>
      <td>
        {{ Form::select('cellgroup', \App\Models\Cellgroup::all()->pluck('name', 'id'), null, ['class' => 'ui fluid dropdown', 'placeholder' => trans('field.cellgroup')]) }}
        @if ($errors->has('cellgroup'))
          <span class="ui red pointing label"> {{ $errors->first('cellgroup') }}</span>
        @endif
      </td>
    </tr>

    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui purple labeled fluid icon button">
            {{trans('usher.newfriend.label.submit')}} <i class="plus icon"></i>
          </button>
        </th>
      </tr>
    </tfoot>
  </table>
  {!! Form::close() !!}
</div>
@endsection
