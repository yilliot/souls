@extends('auth.layout')

@section('title')
    {{trans('auth.merge_nric.title')}} @parent
@endsection

@section('content-blank')
<div class="p-5">
  <h1>{{trans('auth.merge_nric.greet')}}</h1>
  <form class="ui form" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="redirect_url" value="{{$redirect_url}}">
    <div class="field">
      <label for="nric">{{trans('auth.merge_nric.field_nric')}}</label>
      <div class="ui divider"></div>
      <input name="nric" type="text" value="{{old('nric')}}" placeholder="930101-01-1234">
    </div>
    <button class="ui fluid yellow button">{{trans('auth.merge_nric.btn_submit')}}</button>
  </form>
</div>
@endsection