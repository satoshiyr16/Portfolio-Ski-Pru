@extends('layouts.header')
@section('additionHeader')
    <link href="{{ asset('assets/css/article_edit.css') }}" rel="stylesheet" >
    <script src="{{ asset('assets/js/article_edit.js') }}" type="module"></script>
@endsection
@section('content')
<div class="container">
    @if ($errors->any())
        @include('common/validation_error', ['errors' => $errors ])
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
@endsection
