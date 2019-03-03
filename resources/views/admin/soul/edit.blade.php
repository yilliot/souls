@extends('admin.layout')
@section('title')
Update soul
@endsection
@section('content')
<div class="ui text container">
  <h1 class="ui header">Update soul</h1>
  {!! Form::open(['url' => 'admin/soul/' . $soul->id, 'method' => 'POST', 'class' => 'ui form']) !!}
  {{ method_field('PUT') }}
  <table class="ui structured table">
    <tr class="field {{$errors->has('cellgroup') ? 'error' : ''}}">
      <td>
        <b>CG</b>
      </td>
      <td>
        {{ Form::select('cellgroup', \App\Models\CG::all()->pluck('name', 'id'), $soul->cellgroup_id, ['class' => 'ui fluid dropdown', 'placeholder' => 'Choose a cellgroup']) }}
        @if ($errors->has('cellgroup'))
          <span class="ui red pointing label"> {{ $errors->first('cellgroup') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('birthday') ? 'error' : ''}}">
      <td>
        <label for="birthday"><b>Birthday</b></label>
      </td>
      <td class="twelve wide">
        <input type="date" name="birthday" value="{{old('birthday', $soul->birthday)}}">
        @if ($errors->has('birthday'))
          <span class="ui red pointing label"> {{ $errors->first('birthday') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('baptism') ? 'error' : ''}}">
      <td><b>Baptism</b></td>
      <td>
        {{ Form::select('baptism', \App\Models\Baptism::all()->pluck('name', 'id'), $soul->baptism_id, ['class' => 'ui fluid dropdown'] ) }}
        @if ($errors->has('baptism'))
          <span class="ui red pointing label"> {{ $errors->first('baptism') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('baptism_serial') ? 'error' : ''}}">
      <td><b>Baptism Serial</b></td>
      <td>
        {{ Form::text('baptism_serial', $soul->baptism_serial) }}
        @if ($errors->has('baptism_serial'))
          <span class="ui red pointing label"> {{ $errors->first('baptism_serial') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('is_active') ? 'error' : ''}}">
      <td>
        <b>Is Active</b>
      </td>
      <td>
        {{ Form::select('is_active', \App\Enums\Boolean::all(), $soul->is_active, ['class' => 'ui fluid dropdown']) }}
        @if ($errors->has('is_active'))
          <span class="ui red pointing label"> {{ $errors->first('is_active') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('nric') ? 'error' : ''}}">
      <td><b>NRIC</b></td>
      <td>
        {{ Form::text('nric', $soul->nric, ['placeholder' => trans('field.nric')]) }}
        @if ($errors->has('nric'))
          <span class="ui red pointing label"> {{ $errors->first('nric') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('nric_fullname') ? 'error' : ''}}">
      <td><b>NRIC Full name</b></td>
      <td>
        {{ Form::text('nric_fullname', $soul->nric_fullname, ['placeholder' => trans('field.nric_fullname')]) }}
        @if ($errors->has('nric_fullname'))
          <span class="ui red pointing label"> {{ $errors->first('nric_fullname') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('nickname') ? 'error' : ''}}">
      <td>
        <b>Nickname</b>
      </td>
      <td>
        {{ Form::text('nickname', $soul->nickname, ['placeholder' => trans('field.nickname')]) }}
        @if ($errors->has('nickname'))
          <span class="ui red pointing label"> {{ $errors->first('nickname') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('email') ? 'error' : ''}}">
      <td><b>Email Address</b></td>
      <td>
        <input type="email" name="email" value="{{old('email', $soul->email)}}" placeholder="{{trans('field.email')}}">
        @if ($errors->has('email'))
          <span class="ui red pointing label"> {{ $errors->first('email') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('contact') ? 'error' : ''}}">
      <td><b>Phone Contact</b></td>
      <td>
        <div class="ui labeled input">
          <i class="ui label">+</i>
          {{ Form::text('contact', $soul->contact, ['placeholder' => 'International format. E.g : 60127654321']) }}
        </div>
        @if ($errors->has('contact'))
          <span class="ui red pointing label"> {{ $errors->first('contact') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{$errors->has('contact2') ? 'error' : ''}}">
      <td><b>Phone Contact 2</b></td>
      <td>
        <div class="ui labeled input">
          <i class="ui label">+</i>
          {{ Form::text('contact2', $soul->contact2, ['placeholder' => 'International format. E.g : 60127654321']) }}
        </div>
        @if ($errors->has('contact2'))
          <span class="ui red pointing label"> {{ $errors->first('contact2') }}</span>
        @endif
      </td>
    </tr>
    <tr class="field {{ $errors->has('address1') || $errors->has('address2') || $errors->has('postal_code') ? 'error' : ''}}">
      <td><b>Address</b></td>
      <td>
        <div class="field">{{ Form::text('address1', $soul->address1, ['placeholder' => trans('field.address1')]) }}</div>
        @if ($errors->has('address1'))
          <span class="ui red pointing label"> {{ $errors->first('address1') }}</span>
        @endif
        <div class="field">{{ Form::text('address2', $soul->address2, ['placeholder' => trans('field.address2')]) }}</div>
        @if ($errors->has('address2'))
          <span class="ui red pointing label"> {{ $errors->first('address2') }}</span>
        @endif
        <div class="field">{{ Form::text('postal_code', $soul->postal_code, ['placeholder' => trans('field.postal_code')]) }}</div>
        @if ($errors->has('postal_code'))
          <span class="ui red pointing label"> {{ $errors->first('postal_code') }}</span>
        @endif
      </td>
    </tr>

    <tfoot class="full-width">
      <tr>
        <th colspan="2">
          <button type="submit" class="ui teal labeled icon button">
            Update <i class="edit icon"></i>
          </button>
          <a href="/admin/soul/{{$soul->id}}" class="ui teal basic button">
            View detail
          </a>
        </th>
      </tr>
    </tfoot>
  </table>
  {!! Form::close() !!}
</div>
@endsection
