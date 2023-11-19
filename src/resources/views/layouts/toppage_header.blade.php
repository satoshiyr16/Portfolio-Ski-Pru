<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ski Pru</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200&display=swap" rel="stylesheet">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('assets/css/toppage_test.css') }}" rel="stylesheet" >
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="l-top_page_wrapper">
    <div class="l-header_area">
        <div class="p-header_img_area">
            <img class="logo_img" src="{{ asset('images/logo_img.png') }}">
        </div>
        @if (Route::has('login'))
        <div class="p-header_button_area">
            @auth
                <a href="{{ route('home') }}"><button class="auth_btn header_area_ver">ホームへ</button></a>
            @else
                <a href="{{ route('guest.login') }}"><button class="auth_btn header_area_ver">ゲストログイン</button></a>
            @endauth
        </div>
        @endif
    </div>
    <div class="l-main_img_area">
        <img class="main_img" src="{{ asset('images/toppage_banner.png') }}">
        <img class="main_img_pc_ver" src="{{ asset('images/toppage_banner_pc_ver.png') }}">
    </div>
    @if (Route::has('login'))
        @auth
        @else
        <div class="l-auth_area">
            <div class="p-guest_login_area">
                <p class="auth_text">ゲストログインはこちらから</p>
                <a href="{{ route('guest.login') }}">
                    <button class="auth_btn auth_area_ver">ゲストログイン</button>
                </a>
            </div>
            <div class="p-registration_login_area">
                <div class="c-registration_login">
                    <p class="auth_text">新規登録はこちらから</p>
                    <a href="{{ route('register') }}">
                        <button class="auth_btn auth_area_ver">新規登録</button>
                    </a>
                </div>
                <div class="c-registration_login">
                    <p class="auth_text">ログインはこちらから</p>
                    <a href="{{ route('login') }}">
                        <button class="auth_btn auth_area_ver">ログイン</button>
                    </a>
                </div>
            </div>
        </div>
        @endauth
    @endif
    <div class="l-function_introduction_area">
        <h3 class="p-function_area_title">機能の説明</h3>
        <div class="p-introduction_area">
            <div class="introduction_text">
                <p class="function_title orange">日記機能</p>
                <p class="introduction">
                    肌トラブルは明日急に<br>治るものではありません<span class="br_pc"><br></span>
                </p>
                <p class="introduction">
                    原因となる食生活・睡眠・スキンケアなどの原因の可視化,<span class="br_pc"><br></span>セルフケア継続を手助けします
                </p>
            </div>
            <img class="diary_img" src="{{ asset('images/diary.png') }}">
        </div>
        <div class="p-introduction_area">
            <img class="calendar_img" src="{{ asset('images/calendar.jpg') }}">
            <div class="introduction_text">
                <p class="function_title yellow_green">カレンダー機能</p>
                <p class="introduction">
                    セルフケア情報をカレンダーを通して見ることができます
                </p>
                <p class="introduction">
                    毎日記録した情報から, 新たなアイテムを用いて変化がどのようにあったかなどを確認しよう
                </p>
            </div>
        </div>
        <div class="p-introduction_area">
            <div class="introduction_text">
                <p class="function_title light_blue">肌の悩み解決</p>
                <p class="introduction">
                    肌トラブルは明日急に<br>治るものではありません
                </p>
                <p class="introduction">
                    原因となる食生活・睡眠・スキンケアなどの原因の可視化,<br>セルフケア継続を手助けします
                </p>
            </div>
            <img class="diary_img" src="{{ asset('images/posts.jpg') }}">
        </div>
    </div>
</div>
</body>
</html>
