@extends('layouts.copy')

@section('content')
<head>
  <link href="{{ asset('assets/css/calendar.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
  <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="article_blade_area">
  @if($today_diary)
  <div class="today_diary_area">
    <h1 class="date_title">{{ $today_diary->date }}</h1>
    <div class="diary_content_area">
      <div class="skin_tone_area">
        <p>
          @switch($today_diary->skin_tone)
              @case('良い')
                <i class="fas fa-laugh-beam fa-5x" style="color: #ffa53f"> 良い</i>
                @break
              @case('少し良い')
                <i class="fas fa-laugh fa-5x" style="color: #ffc787"> 少し良い</i>
                @break
              @case('普通')
                <i class="fas fa-meh fa-5x" style="color: #ffe033"> ふつう</i>
                @break
              @case('少し悪い')
                <i class="fas fa-frown fa-5x" style="color: #acd6fd"> 少し悪い</i>
                @break
              @case('悪い')
                <i class="fas fa-dizzy fa-5x" style="color: #665cff"> 悪い</i>
                @break
          @endswitch
        </p>
      </div>
      <div class="double_content_area">
        <div class="single_content_area">
          <p>肌の状態：{{ $today_diary->skin_status }}</p>
          @if($today_diary->skin_status_text)
          <p class="content_text"> {{ $today_diary->skin_status_text }}</p>
          @else
          <p class="sub_text">詳細なし</p>
          @endif
        </div>
        <div class="single_content_area">
          <p> ニキビ：{{ $today_diary->acne }}</p>
          @if($today_diary->acne_status_text)
          <p class="content_text"> {{ $today_diary->acne_status_text }}</p>
          @else
          <p class="sub_text">詳細なし</p>
          @endif
        </div>
      </div>
      <div class="double_content_area">
        <div class="single_content_area">
          <p class="food"> 食べ物：{{ $today_diary->food }}</p>
          @if($today_diary->food_content_text)
            <p class="content_text"> {{ $today_diary->food_content_text }}</p>
          @else
            <p class="sub_text">詳細なし</p>
          @endif
        </div>
        <div class="single_content_area">
          <p class="skincare"> スキンケア：{{ $today_diary->skincare }}</p>
          @if($today_diary->skincare_content_text)
            <p class="content_text"> {{ $today_diary->skincare_content_text }}</p>
          @else
            <p class="sub_text">詳細なし</p>
          @endif
        </div>
      </div>
      <div class="double_content_area">
        <div class="single_content_area">
          <p> 睡眠：{{ $today_diary->sleep }}</p>
        </div>
        <div class="single_content_area">
          <p> 排便：{{ $today_diary->defecation }}</p>
        </div>
      </div>
      <div class="double_content_area">
        <div class="single_content_area">
          <p> 洗顔：{{ $today_diary->face_wash }}</p>
        </div>
        <div class="single_content_area">
          <p> 生理：{{ $today_diary->menstruation }}</p>
        </div>
      </div>
      <div class="edit_modal_area">
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-left: 10px">
          画像を見る
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">画像</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                @if($images)
                @foreach ($images as $image)
                <img src="{{ asset($image) }}" alt="image" style="width: 200px; height:200px;">
                @endforeach
                @endif
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="diary_edit_area">
          <a class="diary_edit" href="{{ route('diary_edit', ['date'=>$today]) }}">肌日記を編集する →</a>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="today_diary_area">
    <h1 class="date_title">{{ $today }}</h1>
    <h2 class="diary_none_text">今日の肌日記はまだありません</h2>
    <div class="diary_click_area">
      <a class="diary_click" href="{{ route('diary', ['date'=>$today]) }}">今日の肌日記をつける →</a>
    </div>
  </div>
  @endif
  <div id="article_content">
    <h3 class="area_title">フォロー中</h3>
    <div class="article_area">
      @if($follow_articles->isEmpty())
        <h3 class="none_article">投稿はありません</h3>
      @else
        @foreach($follow_articles as $follow_article)
          <div class="article">
            <div class="pro_img">
              <a href="{{ route('article_view',['id'=>$follow_article->id]) }}">
              @if(isset( $follow_article->path ))
                <img class="article_img" src="{{ asset($follow_article->path) }}">
              @else
                <img class="article_img" src="{{ asset('images/article.jpg') }}">
              @endif
              </a>
            </div>
            <div class="pro_title">
              <div class="position1">
                <a href="{{ route('article_view', ['id'=>$follow_article->id]) }}" class="title">
                <p class="article_title">{{$follow_article->title}}</p>
                </a>
              </div>
              <div class="position2">
                <p class="like_count"><i class="fas fa-heart fa-lg like"></i>{{$follow_article->likes_count}}</p>
                <div class="name_date_area">
                  <p class="article_user_name">{{ $follow_article->user->name }}</p>
                  <p class="article_date">{{ \Carbon\Carbon::createFromTimeString($follow_article->updated_at)->format('Y/m/d') }}</p>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
    <div class="pagination">
    {!! $follow_articles->links('pagination::bootstrap-4') !!}
    </div>
  </div>
  <div id="article_content">
    <h3 class="area_title">新規投稿</h3>
    <div class="article_area">
      @if($new_articles->isEmpty())
        <h3 class="none_article">投稿はありません</h3>
      @else
        @foreach($new_articles as $new_article)
          <div class="article">
            <div class="pro_img">
              <a href="{{ route('article_view',['id'=>$new_article->id]) }}">
              @if(isset( $new_article->path ))
                <img class="article_img" src="{{ asset($new_article->path) }}">
              @else
                <img class="article_img" src="{{ asset('images/article.jpg') }}">
              @endif
              </a>
            </div>
            <div class="pro_title">
              <div class="position1">
                <a href="{{ route('article_view', ['id'=>$new_article->id]) }}" class="title">
                <p class="article_title">{{$new_article->title}}</p>
                </a>
              </div>
              <div class="position2">
                <p class="like_count"><i class="fas fa-heart fa-lg like"></i>{{$new_article->likes_count}}</p>
                <div class="name_date_area">
                  <p class="article_user_name">{{ $new_article->user->name}}</p>
                  <p class="article_date">{{ \Carbon\Carbon::createFromTimeString($new_article->updated_at)->format('Y/m/d') }}</p>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
    {{-- <div class="pagination">
    {!! $new_articles->links('pagination::bootstrap-4') !!}
    </div> --}}
  </div>
</div>

@endsection
