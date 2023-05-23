<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>肌プル</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@500&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/top.css') }}" rel="stylesheet" >

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="container-fluid">
            <div class="vh-100">
                @if (Route::has('login'))
                        <div class="row position-fixed w-100 justify-content-end">
                            @auth
                                <a href="{{ url('/home') }}" button type="button" class="btn btn-secondary m-2 col-1">Home</button></a>
                            @else
                                <a href="{{ route('login') }}" button type="button" class="btn btn-dark m-1 col-1">ログイン</button></a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" button type="button" class="btn btn-dark m-1 col-1">新規登録</button></a>
                                @endif
                            @endauth
                        </div>
                    @endif
                    <div class="row h-100 d-flex flex-column justify-content-center">
                        <div class="col-12 d-flex justify-content-center">
                            <p class="text-white" style="font-size: 150px">Ski Pru</p>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <p class="text-white mt-5" style="font-size: 24px">\ 肌のセルフケアを手助けする /</p>
                    </div>
            </div>
        </div>
    </body>
</html>
