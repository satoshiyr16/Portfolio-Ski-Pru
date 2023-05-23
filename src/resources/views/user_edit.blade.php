@extends('layouts.copy')

@section('content')
<head>
  <link href="{{ asset('assets/css/user_edit.css') }} " rel="stylesheet">
  <link href="{{ asset('assets/css/mycrop.css') }}" rel="stylesheet" >
  <link  href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" rel="stylesheet">
  <link  href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
<div class="container">
  <div class="edit_content_area">
  <form action="{{ route('user_update') }}" method="post" enctype="multipart/form-data">
  @csrf
    <div id="edit_area">
      <div class="img_edit">
        <img id="show" src="">
        @if(Auth::user()->path)
        <img src="{{ (Auth::user()->path) }}" class="user_img">
        @else
        <img class="user_img" src="{{ asset('images/article.jpg') }}">
        @endif
        <input type="file" id="file" name="image">
      </div>
      <div class="text_edit">
        <div class="text">
          <p class="user_name">name</p>
          <input type="text" id="name" placeholder="{{ (Auth::user()->name) }}" name="name">
        </div>
        <div class="introduction">
          <p class="introduction_content">introduction</p>
          <textarea type="text" id="introduction" placeholder="{{ (Auth::user()->introduction) }}" name="introduction"></textarea>
        </div>
        <button type="submit" class="update_btn">更新</button>
      </div>
    </div>
  </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
<script src="{{ asset('assets/js/mycrop.js') }}"></script>
</body>

@endsection
