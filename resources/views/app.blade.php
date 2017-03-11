<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="apple-mobile-web-app-status-bar-style" content="white">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="Tap Based Authentication">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tap Based Authentication</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone.png">
        <link rel="apple-touch-startup-image" href="launch.png">
        <link rel="icon" type="image/png" href="favicon.png">

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};

            @if (Auth::check())
            window.User = {!! Auth::user()->toJson() !!}
            @else
            window.User = null;
            @endif
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="app">

            <app-nav></app-nav>

            <transition name="slide" mode="out-in">
                <router-view></router-view>
            </transition>

        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
