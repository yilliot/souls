<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

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

            body{
                animation: trans_bg 2s ease-in-out 1;
                background-color: black;
            }
            @keyframes trans_bg {
              0% {background-color: white;}
              100% {background-color: black;}
            } 

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
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

            a {
                color: white;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                text-align: center;
                display: block;
                width: 100%;
            }
        </style>
    </head>
    <body>
            <a href="https://calendar.google.com/calendar/ical/kle1k9qibv6pgcu0dvh9gh2gkk%40group.calendar.google.com/public/basic.ics">Calendar link</a>
            <textarea style='width:100%'>https://calendar.google.com/calendar/ical/kle1k9qibv6pgcu0dvh9gh2gkk%40group.calendar.google.com/public/basic.ics</textarea>
        <iframe src="https://calendar.google.com/calendar/embed?src=kle1k9qibv6pgcu0dvh9gh2gkk%40group.calendar.google.com&ctz=Asia%2FSingapore" style="border: 0" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
    </body>
</html>
