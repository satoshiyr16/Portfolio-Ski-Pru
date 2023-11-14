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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yomogi&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/toppage.css') }}" rel="stylesheet" >

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="toppage_area">
    <div id="top_area">
        <div class="title_login_area">
            <div class="title_area">
                <p class="title">Ski Pru</p>
                <p class="subtitle">~ 肌のセルフケアを手助けする ~</p>
            </div>
            @if (Route::has('login'))
            <div class="login_area">
                @auth
                    <a href="{{ url('/home') }}"><button type="button" class="login">ホームへ</button></a>
                @else
                    <a href="{{ route('login') }}"><button type="button" class="login">ログイン</button></a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"><button type="button" class="login">新規登録</button></a>
                    @endif
                    <a href="{{ route('guest.login') }}"><button type="button" class="login">ゲストログイン</button></a>
                @endauth
            </div>
            @endif
        </div>
        <div class="function_area">
            <div class="content_area">
                <p class="content_title">①  日記機能</p>
                <div class="text_img_area">
                    <div class="text_area">
                        <p class="text">毎日の肌ケアを記録して<span class="red">原因</span>を可視化しよう</p>
                        <p class="sub_text">肌トラブルは明日急に治るものではありません<br>原因となる食生活・睡眠・スキンケアなどの原因の可視化,<br>セルフケア継続を手助けします
                        </p>
                    </div>
                    <img class="img_1" src="{{ asset('images/diary.jpg') }}">
                </div>
            </div>
            <div class="content_area">
                <p class="content_title">② 肌の悩み解決</p>
                <div class="text_img_area">
                    <img class="img_2" src="{{ asset('images/posts.jpg') }}">
                    <div class="text_area">
                        <p class="text">他ユーザーの情報を見て聞いて<span class="red">悩み</span>を解決しよう</p>
                        <p class="sub_text">投稿機能やDM機能, いいね機能や検索機能などを揃えています<br>他ユーザーの投稿やプロフを見たり<br>自分の肌ケア方法や悩みを投稿し, 同じ境遇の人と繋がることができます<br>また, メッセージ機能でダイレクトに他ユーザと繋がることも可能です
                        </p>
                    </div>
                </div>
            </div>
            <div class="content_area">
                <p class="content_title">③  カレンダー機能</p>
                <div class="text_img_area">
                    <div class="text_area">
                        <p class="text">長期間の肌状況を見て<span class="orange">成果</span>を感じよう</p>
                        <p class="sub_text">継続したセルフケアの情報をカレンダーを通して見ることができます<br>毎日記録した情報から, 新たなアイテムを用いて変化がどのように<br>あったかなどを確認しましょう
                        </p>
                    </div>
                    <img class="img_3" src="{{ asset('images/calendar.jpg') }}">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
