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
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('assets/css/layout.css') }}" rel="stylesheet" >


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<!-- <nav class="navbar navbar-expand-md navbar-light"> -->
<div class="container">
    <div class="header_area">
        <div id="header_title_area">
            <a class="header_title" href="{{ url('/') }}">Ski Pru</a>
        </div>
        <div class="notification_nav_area">
            <div class="notification_area">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="font-size: large">通知<i class="far fa-bell" style="margin-left: 5px"></i></a>
                    <ul class="dropdown-menu notification_scroll" style="border: none;
                    background: rgba(255,255,255,0.5);">
                    @if(auth()->user()->notifications->isNotEmpty())
                        <li><a class="dropdown-item" id="delete-notifications-btn">すべての通知を消す</a></li>
                        @foreach(auth()->user()->notifications()->get(); as $notification)
                            @if(!empty($notification->data['message']))
                            <p class="notification_content">{{ $notification->data['message']}}</p>
                            @endif
                            @if(!empty($notification->data['comment']))
                            <p class="notification_content">{{ $notification->data['comment']}}</p>
                            @endif
                            @if(!empty($notification->data['follow']))
                            <p class="notification_content">{{ $notification->data['follow']}}</p>
                            @endif
                        @endforeach
                    @else
                    <p class="none_notification">通知はありません</p>
                    @endif
                    </ul>
                </div>
            </div>
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
</div>
<main class="py-4">
    @yield('content')
</main>

<script src="{{ asset('assets/js/layouts.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="module">
    $(document).ready(function() {
        $('#delete-notifications-btn').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("notifications_delete") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // 削除成功時の処理
                    console.log('通知が削除されました');
                    location.reload();
                },
                error: function(xhr) {
                    // エラー時の処理
                    console.log('削除エラー');
                }
            });
        });
    });
</script>
</body>
</html>
