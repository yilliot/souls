@extends('future_fund.ff2020.layout-auth')

@section('title')
{{trans('futuresoul.greet')}}
@endsection

@section('content-blank')


<div class="p-5">
  <h1>{{trans('futuresoul.greet')}}</h1>
  <div class="ui divider"></div>
  <form class="ui form" method="GET" action="/ff/{{$session->code}}/landing">
    <div class="field">
      <label for="nric">{{trans('auth.merge_nric.field_nric')}}</label>
      <input name="nric" type="text" value="{{old('nric', $nric)}}" placeholder="930101-01-1234">
    </div>
    @if ($errors->has('nric'))
      <label > * {{ $errors->first('nric') }}</label>
    @endif

    <button class="ui fluid yellow button">{{trans('auth.merge_nric.btn_submit')}}</button>
  </form>
</div>

<div style="padding-top: 10px"></div>


@endsection
