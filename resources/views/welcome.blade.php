<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/event.bible-reading.css') }}" rel="stylesheet">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            /*body{
                animation: trans_bg 2s ease-in-out 1;
                background-color: black;
            }
            @keyframes trans_bg {
              0% {background-color: white;}
              100% {background-color: black;}
            }*/

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                /*display: flex;*/
                justify-content: center;
                /*flex-flow: row wrap;*/
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .massive.lean.button {
                font-weight: lighter;
            }
            
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <h1 class="ui center aligned icon header">
              <a href="/">
                <img id="logo" src="/images/OASIS_logo-01-320.jpg" alt="OASIS" style="position: relative; left: -1px;">
              </a>
            </h1>
            <div class="ui hidden divider"></div>
            <a href="/ff/ff2020" class="ui massive fluid black button lean">
                Future Fund 2020
            </a>
            <div class="ui hidden divider"></div>
            <a href="/ff/fs2020" class="ui massive fluid black button lean">
                New Soul 2020
            </a>
            <div class="ui hidden divider"></div>
            <a href="/invite" class="ui massive fluid black button lean">
                Calendar
            </a>
            
            {{-- <div class="content">
                <div class="title m-b-md">
                    {{config('app.name')}}
                </div>
            </div> --}}
        </div>
    </body>
</html>
