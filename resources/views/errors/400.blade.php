@extends('auth.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Error - 400</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{$exception->getMessage()}}

                    <h2>Debug : </h2>
                    @if (env('APP_DEBUG'))
                        {{$exception}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
