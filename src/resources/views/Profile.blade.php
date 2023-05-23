@extends('layouts.copy')

@section('content')
<head>
    <link href="{{ asset('assets/css/Profile.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="container">
    <div id="profile_page">
        <div id="profile_content">
            <div class="profile_area">
                <div class="profile">
                    @if(Auth::user()->path)
                    <img src="{{ Auth::user()->path }}" class="profile_img" alt="プロフィール画像">
                    @else
                    <img class="profile_img" src="{{ asset('images/Profile.png') }}">
                    @endif
                    <div class="profile_text">
                        @if (Auth::check())
                        <p class="profile_name">{{ Auth::user()->name }}</p>
                        <div class="follow_area">
                        <a class="follow_click" href="{{ route('follow_page') }}">
                            <p class="profile_follow">フォロー：{{ $followCount }}</p>
                        </a>
                        <a class="follow_click" href="{{ route('follower_page') }}">
                            <p class="profile_follower">フォロワー：{{ $followerCount }}</p>
                        </a>
                        </div>
                        <p class="profile_intro">{{ Auth::user()->introduction }} </p>
                        @endif
                    </div>
                </div>
                <a class="profile_btn" href="{{ route('user_edit') }}">プロフィール編集</a>
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
                            <div class="position1">
                            <a href="{{ route('article_view', ['id'=>$article->id]) }}" class="title">
                            <p class="article_title">{{ $article['title'] }}</p>
                            </a>
                            </div>
                            <div class="position2">
                            <p class="article_date">{{ \Carbon\Carbon::createFromTimeString($article->updated_at)->format('Y/m/d') }}</p>
                            </div>
                        </div>
                        <div class="pro_edit">
                            <a href="{{ route('article_edit', ['id'=>$article->id]) }}" clsdd="edit_btn"><i class="fas fa-edit fa-lg" style="color: #000000;"></i></a>
                        </div>
                        <div class="pro_delete">
                        @csrf
                        <form action="{{ route('destroy', ['id'=>$article->id]) }}" method="POST" enctype="multipart/form-data">
                            <button type="submit" class="delete_btn"><i class="fas fa-trash fa-lg"></i></button>
                        </div>
                        </form>
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
