@extends('layouts.copy')

@section('content')
<head>
  <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="{{ asset('assets/css/follower_page.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="follow_edit">
  <div class="follow_page">
    <a class="follow_click" href="{{ route('follow_page') }}">フォロー欄へ</a>
  </div>
  <div class="follow_area">
      <p class="follow_title">フォロワー</p>
      @foreach($followers as $index=>$follower)
      <div class="follow_user">
        <p class="follow_name"><a class="user_page"href="{{ route('user_page', ['id'=>$follower->id]) }}">{{ $follower->name }}</a></p>
        <button class="un_follow" id="un_follow{{ $index }}" onclick="destroy({{ $follower->id }},{{ $index }})">フォロー解除</button>
        <button class="follow" id="follow{{ $index }}" onclick="follow({{ $follower->id }},{{ $index }})" style="display: none">フォロー</button>
      </div>
      @endforeach
  </div>
  <div class="pagination">
  {!! $followers->links('pagination::bootstrap-4') !!}
  </div>
</div>
</body>
<script>
  function follow(userId,index) {
  $('#follow'+index).css("display", "none");
  $('#un_follow'+index).css("display", "block");
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
@endsection
