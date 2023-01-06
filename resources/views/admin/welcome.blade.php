<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

    </head>
    <body>
        <div id="app"></div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwzTpgWpLqRWBEk3U9b2Dx8LXJYAAAUyA"></script>
         <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
