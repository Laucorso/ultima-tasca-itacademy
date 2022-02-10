<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}">
    <title>@yield('title')</title>
</head>
    <div class = "content">
        <body>
            @yield('content')
            
            <script src= "{!! asset('theme/main.js') !!}"></script>
        </body>
    </div>
</html>