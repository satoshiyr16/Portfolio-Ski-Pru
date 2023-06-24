@extends('layouts.copy')

@section('content')
<head>
    <link href="{{ asset('assets/css/Profile.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="container">
    <div id="profile_blade_page">
        <div class="profile_area">
            <div class="img_text_area">
                <div class="img_area">
                @if(Auth::user()->path)
                <img src="{{ Auth::user()->path }}" class="profile_img" alt="プロフィール画像">
                @else
                <img class="profile_img" src="{{ asset('images/Profile.png') }}">
                @endif
                </div>
                <div class="text_area">
                    @if (Auth::check())
                    <p class="name">{{ Auth::user()->name }}</p>
                    <div class="follow_area">
                        <a class="follow_click" href="{{ route('follow_page') }}">
                            <p class="follow">フォロー：{{ $followCount }}</p>
                        </a>
                        <a class="follow_click" href="{{ route('follower_page') }}">
                            <p class="follower">フォロワー：{{ $followerCount }}</p>
                        </a>
                    </div>
                    @endif
                    <p class="intro">{{ Auth::user()->introduction }} </p>
                </div>
            </div>
            <a class="edit_btn" href="{{ route('user_edit') }}">プロフィール編集</a>
        </div>
        <div class="article_area">
            <div class="article_content_area">
                <p class="article_area_title">自分の投稿</p>
                <div class="article_content">
                    @foreach($articles as $article)
                        <div class="article">
                            <div class="image_area">
                                <a href="{{ route('article_view', ['id'=>$article->id]) }}">
                                @if(isset( $article->path ))
                                    <img class="article_img" src="{{ asset($article->path) }}">
                                @else
                                    <img class="article_img" src="{{ asset('images/article.jpg') }}">
                                @endif
                                </a>
                            </div>
                            <div class="title_date_area">
                                <a href="{{ route('article_view', ['id'=>$article->id]) }}" class="title_click">
                                <p class="title">{{ $article['title'] }}</p>
                                </a>
                                <p class="date">{{ \Carbon\Carbon::createFromTimeString($article->updated_at)->format('Y/m/d') }}</p>
                            </div>
                            <div class="edit">
                                <a href="{{ route('article_edit', ['id'=>$article->id]) }}" claas="edit_btn"><i class="fas fa-edit fa-lg" style="color: #000000;"></i></a>
                            </div>
                            <div class="delete">
                                <form action="{{ route('destroy', ['id'=>$article->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="delete_btn"><i class="fas fa-trash fa-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination" style="display:flex; justify-content: center;margin-top: 20px;">
                    {!! $articles->links('pagination::bootstrap-4') !!}
                </div>
            </div>
            <div class="article_content_area">
                <p class="article_area_title">いいねした投稿</p>
                <div class="article_content">
                    @foreach($like_articles as $like_article)
                        <div class="article">
                            <div class="image_area_like_ver">
                                <a href="{{ route('article_view', ['id'=>$like_article->id]) }}">
                                @if(isset( $like_article->path ))
                                    <img class="article_img_like_ver" src="{{ asset($like_article->path) }}">
                                @else
                                    <img class="article_img_like_ver" src="{{ asset('images/article.jpg') }}">
                                @endif
                                </a>
                            </div>
                            <div class="title_date_area_like_ver">
                                <a href="{{ route('article_view', ['id'=>$like_article->id]) }}" class="title_click">
                                <p class="title">{{ $like_article['title'] }}</p>
                                </a>
                                <p class="date">{{ \Carbon\Carbon::createFromTimeString($like_article->updated_at)->format('Y/m/d') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination" style="display:flex; justify-content: center;margin-top: 20px;">
                    {!! $like_articles->links('pagination::bootstrap-4') !!}
                </div>
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

function destroy(userId,index) {
    $('#follow'+index).css('display','block');
    $('#un_follow'+index).css('display','none');
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
