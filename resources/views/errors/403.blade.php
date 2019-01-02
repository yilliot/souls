@extends('auth.layout')
@section('content-blank')
<h1 class="ui header">Error - 403</h1>
<form action="/auth/logout" method="post">
    {{csrf_field()}}
    <button class="ui button">logout</button>
</form>
<div class="panel-body">
{{$exception->getMessage()}}
<h2>Debug : </h2>
@if (env('APP_DEBUG'))
    {{$exception}}
@endif
</div>
@endsection
