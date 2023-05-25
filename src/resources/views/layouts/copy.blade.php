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
        <div class="notifications">
            @forelse(auth()->user()->notifications()->take(5)->get() as $notification)
                <div class="{{ is_null($notification->read_at) ? 'un-read' : '' }}">
                    <p>{{ $notification->data['message']}}</p>
                </div>
            @empty
                <p>まだ通知はありません</p>
            @endforelse
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
<main class="py-4">
    @yield('content')
</main>

<script src="{{ asset('assets/js/layouts.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="module">
//     $(document).ready(function() {
//     // ページ読み込み時に通知を取得
//     // getNotifications();

//     // お知らせボタンがクリックされた時の処理
//     $('#notification-button').click(function() {
//         // 通知を取得
//         getNotifications();
//     });
// });

// function getNotifications() {
//     $.ajax({
//         url: '/notifications', // 通知を取得するAPIのエンドポイント
//         type: 'GET',
//         dataType: 'json',
//         success: function(response) {
//             // 通知を表示するための処理
//             displayNotifications(response);
//         },
//         error: function(xhr, status, error) {
//             console.log(xhr.responseText);
//         }
//     });
// }

// function displayNotifications(notifications) {
//     var notificationsContainer = $('#notifications');

//     // 通知を表示するための処理を実装
//     notificationsContainer.empty(); // 既存の通知をクリア

//     if (notifications.length === 0) {
//         notificationsContainer.append('<p>通知はありません。</p>');
//     } else {
//         notifications.forEach(function(notification) {
//             notificationsContainer.append('<p>' + notification.message + '</p>');
//         });
//     }
// }

</script>
</body>
</html>
