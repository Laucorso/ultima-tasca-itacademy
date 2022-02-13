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
        <div class="min-h-screen flex flex-col">

        <body>
                <!--Container -->
            <div class="mx-auto bg-grey-400">
                <!--Screen-->
                <div class="min-h-screen flex flex-col">
                    
                    <!--Header Section Starts Here-->
                    @include('layouts.partials.header')
                    <!--/Header-->
            
                    <div class="flex flex-1">
                        <!--Main-->
                        <main class="bg-white-300 flex-1 p-3 overflow-hidden">
                                        
                            @yield('content')
                                                    
                        </main>
                        <!--/Main-->
                    </div>
                    
                </div>
            </div>
            <script src= "{!! asset('theme/main.js') !!}"></script>
        </body>
    </div>
</html>