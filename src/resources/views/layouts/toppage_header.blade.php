<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ski Pru</title>
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('assets/css/toppage_test.css') }}" rel="stylesheet" >
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="l-top_page-wrapper">
    <div class="p-header_area">
        <div class="p-header_img_area">
            <img class="logo_img" src="{{ asset('images/logo_img.png') }}">
        </div>
        <div class="p-header_button_area">
            <button class="guest_login_btn">ゲストログイン</button>
        </div>
    </div>
    <div class="p-main_img_area">
        <img class="main_img" src="{{ asset('images/toppage_banner.png') }}">
    </div>
    <div class="p-login_registration_area">

    </div>
</div>
</body>
</html>
