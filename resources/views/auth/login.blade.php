@extends('auth.layout')

@section('title')
    {{trans('auth.login.title')}} @parent
@endsection

@section('content-blank')
<h1> {{ trans('auth.login.greet') }} </h1>
<i class="android icon"></i>
{{ trans('auth.login.intro') }}

<div class="ui divider"></div>

<a class="ui facebook fluid button" href="/auth/facebook">
    <i class="facebook icon"></i>
    {{trans('auth.login.btn_fb')}}
</a>
@endsection