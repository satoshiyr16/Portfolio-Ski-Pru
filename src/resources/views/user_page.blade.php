@extends('layouts.copy')

@section('content')
<head>
    <link href="{{ asset('assets/css/user_page.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
<div class="container">
    <div id="profile_page">
        <div id="profile_content">
            <div class="profile_area">
                <div class="profile">
                    @if($users->path)
                    <img src="{{  asset($users->path) }}" class="profile_img" alt="プロフィール画像">
                    @else
                    <img class="profile_img" src="{{ asset('images/article.jpg') }}">
                    @endif
                    <div class="profile_text">
                        <div class="users_area">
                            <p class="profile_name">{{ $users->name }}</p>
                            <div class="follow_btn">
                                @if(isset( $already_followed ))
                                    <button class="follow" onclick="follow({{ $users->id }})" style="display: none">フォロー</button>
                                    <button class="un_follow" onclick="destroy({{ $users->id }})">フォロー解除</button>
                                @else
                                    <button class="follow" onclick="follow({{ $users->id }})">フォロー</button>
                                    <button class="un_follow" onclick="destroy({{ $users->id }})" style="display: none">フォロー解除</button>
                                @endif
                                <a href="{{ route('message_form', ['userId'=>$users->id]) }}">
                                <i class="far fa-envelope fa-lg message"></i>
                                </a>
                            </div>
                        </div>
                        <div class="follow_area">
                            <p class="profile_follow">フォロー：{{ $followCount }}</p>
                            <p class="profile_follower">フォロワー：{{ $followerCount }}</p>
                        </div>
                        <p class="profile_intro">{{ $users->introduction }} </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="article_content">
            <div class="article_area">
                @foreach($articles as $article)
                    <div class="article">
                        <div class="pro_img">
                            <a href="{{ route('article_view', ['id'=>$article->id]) }}">
                            @if(isset( $article->path ))
                                <img class="article_img" src="{{ asset($article->path) }}">
                            @else
                                <img class="article_img" src="{{ asset('images/article.jpg') }}">
                            @endif
                            </a>
                        </div>
                        <div class="pro_title">
                            <a href="{{ route('article_view', ['id'=>$article->id]) }}" class="title">
                            <p class="article_title">{{ $article['title'] }}</p>
                            </a>
                        </div>
                        <div class="pro_date">
                            <p class="article_date">{{ \Carbon\Carbon::createFromTimeString($article->updated_at)->format('Y/m/d') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination">
                {!! $articles->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>
<script>
    function follow(userId) {
    $('.follow').css("display", "none");
    $('.un_follow').css("display", "block");
    $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    url: `/follow/${userId}`,
    type: "POST",
    })
    .done((data) => {
        console.log(data);
    })
    .fail((data) => {
        console.log(data);
    });
    }

function destroy(userId) {
    $('.follow').css('display','block');
    $('.un_follow').css('display','none');
    $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    url: `/follow/${userId}/destroy`,
    type: "POST",
    })
    .done((data) => {
    console.log(data);
    })
    .fail((data) => {
    console.log(data);
    });
}
</script>
</body>
@endsection
