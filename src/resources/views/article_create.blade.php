@extends('layouts.header')
@section('additionHeader')
    <link href="{{ asset('assets/css/article_create.css') }}" rel="stylesheet" >
    <script src="{{ asset('assets/js/article_create.js') }}" type="module"></script>
@endsection
@section('content')
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
    <div class="create_area">
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <p class="name">新規投稿</p>
        <div class="text_area">
            <div class="title_area">
                <input type="title" class="title" id="" placeholder="タイトル" name="title" value="{{ old('title') }}">
            </div>
            <div class="tag_area">
                <input type="text" class="tag" name="tag[]" placeholder="タグ">
            </div>
            <div class="file_area">
                <input type="file" class="file" name="image">
            </div>
            <div class="content_area">
                <textarea class="content" placeholder="悩み" id="" name="content">{{ old('content') }}</textarea>
            </div>
        </div>
        <div class="button_area">
            <button type="submit" class="post">投稿</button>
        </div>
    </form>
    </div>
</div>
@endsection
