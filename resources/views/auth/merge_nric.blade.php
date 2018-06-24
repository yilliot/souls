@extends('auth.layout')

@section('title')
    {{trans('auth.merge_nric.title')}} @parent
@endsection

@section('content-blank')
<h1>{{trans('auth.merge_nric.greet')}}</h1>
<form class="ui form" method="POST" action="/auth/merge/nric">
  {{ csrf_field() }}
  <div class="field">
    <label for="nric">{{trans('auth.merge_nric.field_nric')}}</label>
    <div class="ui divider"></div>
    <input name="nric" type="text" value="{{old('nric')}}" placeholder="930101-01-1234">
  </div>
  <button class="ui fluid yellow button">{{trans('auth.merge_nric.btn_submit')}}</button>
</form>
@endsection