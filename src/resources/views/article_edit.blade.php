@extends('layouts.header')

@section('content')
<head>
    <link href="{{ asset('assets/css/article_edit.css') }}" rel="stylesheet" >
</head>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="edit_area">
        <div class="">
            <form action="{{ route('update', ['id'=>$article->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="edit_image">
                    @if(isset( $article->path ))
                        <img class="image" src="{{ asset($article->path) }}">
                    @else
                        <img class="image" src="{{ asset('images/article.jpg') }}">
                    @endif
                </div>
                <div class="edit_button">
                    <button type="button" class="delete_img">削除</button>
                    <input type="file" class="img_file" name="image">
                </div>
                <div class="edit_title">
                    <input type="title" value="{{ $article['title'] }}" name="title" class="title">
                </div>
                <div class="edit_tag">
                    @foreach($article->tags as $tag)
                    <input type="text" value="{{ $tag->name }}" name="tag[]" class="tag">
                    @endforeach
                    @if($article->tags->count() < 5)
                        <input type="text" name="tag[]" class="tag" placeholder="タグ">
                    @endif
                </div>
                <div class="edit_text">
                    <textarea class="text" placeholder=""  name="content">{{ $article['content'] }}</textarea>
                </div>
                <div class="edit_button">
                    <button type="submit" class="update_btn">更新</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/article_edit.js') }}"></script>
<script type="module">
    let img;
    $('.delete_img').on('click', function () {
        img = $('.image').detach();
        $(".delete_img").css("display", "none");
        $(".img_file").css("display", "block");
    });
    // $('.again_img').on('click', function () {
    //     $('.edit_image').append(img);
    // });
</script>
@endsection
