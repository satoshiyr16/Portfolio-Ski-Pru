@extends('layouts.header')
@section('additionHeader')
    <link href="{{ asset('assets/css/article_search.css') }}" rel="stylesheet" >
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
  @if ($errors->any())
    @include('common/validation_error', [ 'errors' => $errors ])
  @endif
  <div class="search_page_area">
      @include('common/articles/tag_search_form', [
            'searchRoute' => 'article_tag_search',
            'inputName' => 'tag_word',
            'placeholder' => 'タグ名を入力してください',
            'searchType' => 'タグ検索',
            'changeSearchRoute' => 'article_word_search',
            'changeSearchType' => 'タイトル検索'
        ])
    <div class="search_result_area">
      <div class="result_content_area">
        @if(!empty($tag_article_results))
          @include('common/articles/article_search_result',['articleResults' => $tag_article_results])
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
