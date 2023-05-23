@extends('layouts.copy')

@section('content')
<head>
    <link href="{{ asset('assets/css/article_search.css') }}" rel="stylesheet" >
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<div class="container">
  <div class="search_page_area">
    <div class="search_area">
    <form method="GET" action="{{ route('article_tag_search') }}">
      <h3 class="search_title">タグ検索</h3>
      <div class="input_area">
        <input type="text" class="word" name="tag_word" placeholder="タグ名を入力してください">
      </div>
      <div class="btn_area">
        <button type="submit" class="search_btn">検索</button>
      </div>
    </form>
      <div class="search_change_area">
        <a href="{{ route('article_word_search') }}" class="search_change">タイトル検索 →</a>
      </div>
    </div>
    <div class="search_result_area">
      <div class="result_content_area">
        @if(!empty($tag_article_results))
          <div class="article_area row">
            @foreach ($tag_article_results as $tag_article_result)
            <div class="article_content_area col-md-4">
              @if(isset( $tag_article_result->path ))
                <img class="img" src="{{ asset($tag_article_result->path) }}">
              @else
                <img class="img" src="{{ asset('images/article.jpg') }}">
              @endif
                <a class="article_view" href="{{ route('article_view',['id'=>$tag_article_result->id]) }}">
                <p class="title">{{ $tag_article_result->title }}</p>
                </a>
                <div class="article_information_area">
                  <p class="like_count"><i class="fas fa-heart fa-lg like"></i>{{$tag_article_result->likes_count}}</p>
                  <div class="name_date_area">
                    <p class="user_name">{{ $tag_article_result->user_name }}</p>
                    <p class="date">{{ \Carbon\Carbon::createFromTimeString($tag_article_result->updated_at)->format('Y/m/d')}}</p>
                  </div>
                </div>
            </div>
            @endforeach
            <div class="pagination">
              {!! $tag_article_results->appends(request()->input())->links('pagination::bootstrap-4') !!}
            </div>
          </div>
        @else
        <div class="result_none_area">
          <p class="result_none">検索結果はありません</p>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
