<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ski Pru</title>
    <style>
        body {
            background-image: url(../../images/background.png);
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet"> --}}

    <link href="{{ asset('assets/css/layout.css') }}" rel="stylesheet" >

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<!-- <nav class="navbar navbar-expand-md navbar-light"> -->
<div class="container">
    <div id="nav_area">
        <a class="nav_title" href="{{ url('/') }}">
            Ski Pru
        </a>
        <div id="openbtn"><span></span><span></span><span></span></div>
        <nav id="g-nav">
            <div id="g-nav-list">
            <ul>
                <li><a href="{{ url('/home') }}">HOME</a></li>
                <li><a href="{{ url('/Profile') }}">Profile</a></li>
                <li><a href="{{ url('/create') }}">POST</a></li>
                <li><a href="{{ url('/article_tag_search') }}">SEARCH</a></li>
                <li><a href="{{ url('/message') }}">MESSAGE</a></li>
                <li><a href="{{ url('/calendar') }}">CALENDAR</a></li>
                @guest
                    @if (Route::has('login'))
                        <li class="">
                            <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="">
                            <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="">
                    <div class="" aria-labelledby="">
                        <a class="" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            </ul>
            </div>
        </nav>
    </div>
</div>

<main class="py-4">
    @yield('content')
</main>

{{-- <script type="module">
    const open = document.getElementById('openbtn');
    open.addEventListener('click',function(){
        $(this).toggleClass('active');
        $("#g-nav").toggleClass('panelactive');
});
</script> --}}
<script src="{{ asset('assets/js/layouts.js') }}"></script>
</body>
</html>
