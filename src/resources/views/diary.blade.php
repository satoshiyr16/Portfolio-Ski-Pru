@extends('layouts.header')

@section('content')
<head>
  <link href="{{ asset('assets/css/diary.css') }}" rel="stylesheet">
  <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
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
  <div class="calendar_date_area">
  <form action="{{ route('skin_diary') }}" method="POST" enctype="multipart/form-data">
  @csrf
    <div class="date_title_area">
      <h1 class="date_title">{{ $date }}</h1>
      <div class="skin_tone_area">
        <h2 class="skin_tone_title">肌の調子</h2>
        <select class="skin_tone" name="skin_tone">
          <option name="skin_tone" value="良い">良い</option>
          <option name="skin_tone" value="少し良い">少し良い</option>
          <option name="skin_tone" value="普通">普通</option>
          <option name="skin_tone" value="少し悪い">少し悪い</option>
          <option name="skin_tone" value="悪い">悪い</option>
        </select>
      </div>
    </div>
    <div class="calendar_date_content">
      <div class="skin_status_area">
        <h3 class="skin_status_title">肌状態</h3>
        <div class="radio_area">
          <input class="radio" type="radio" name="skin_status" value="特にない" checked>特にない
          <input class="radio" type="radio" name="skin_status" value="ベタベタする">ベタベタする
          <input class="radio" type="radio" name="skin_status" value="乾燥">乾燥
          <input class="radio" type="radio" name="skin_status" value="肌荒れ">肌荒れ
        </div>
        <textarea class="status_text" placeholder="肌の詳しい状態（例：痒みなど）" id="" name="skin_status_text"></textarea>
      </div>
      <div class="skin_status_area">
        <h3 class="skin_status_title">ニキビ</h3>
        <div class="radio_area">
          <input class="radio" type="radio" name="acne" value="ない" checked>ない
          <input class="radio" type="radio" name="acne" value="少しある">少しある
          <input class="radio" type="radio" name="acne" value="ある">ある
        </div>
        <textarea class="status_text" placeholder="ニキビの詳しい状態（例：位置や色味など）" id="" name="acne_status_text"></textarea>
      </div>
      <div class="skin_status_area">
        <h2 class="skin_status_title">食事</h2>
        <div class="radio_area">
          <input class="radio" type="radio" name="food" value="バランス良い">バランス良い
          <input class="radio" type="radio" name="food" value="普通" checked>普通
          <input class="radio" type="radio" name="food" value="バランス悪い">バランス悪い
        </div>
        <textarea class="status_text" placeholder="食事の詳しい詳細（例：食事内容など）" id="" name="food_content_text"></textarea>
      </div>

      <div class="skin_status_area">
        <h2 class="skin_status_title">スキンケア</h2>
        <div class="radio_area">
          <input class="radio" type="radio" name="skincare" value="した" checked>した
          <input class="radio" type="radio" name="skincare" value="してない">してない
        </div>
        <textarea class="status_text" placeholder="スキンケアの詳しい詳細（例：使った道具など）" id="" name="skincare_content_text"></textarea>
      </div>

      <div class="skin_status_area">
        <h2 class="skin_status_title">睡眠</h2>
        <div class="radio_second_area">
          <input class="radio" type="radio" name="sleep" value="9h以上">9h以上
          <input class="radio" type="radio" name="sleep" value="9~6時間" checked>9〜6時間
          <input class="radio" type="radio" name="sleep" value="6~3時間">6〜3時間
          <input class="radio" type="radio" name="sleep" value="3~0時間">3〜0時間
        </div>
      </div>

      <div class="skin_status_area">
        <h2 class="skin_status_title">排便</h2>
        <div class="radio_second_area">
          <input class="radio" type="radio" name="defecation" value="快便" checked>快便
          <input class="radio" type="radio" name="defecation" value="普通" checked>普通
          <input class="radio" type="radio" name="defecation" value="便秘">便秘
          <input class="radio" type="radio" name="defecation" value="下痢">下痢
        </div>
      </div>

      <div class="skin_status_area">
        <h2 class="skin_status_title">洗顔</h2>
        <div class="radio_area">
          <input class="radio" type="radio" name="face_wash" value="3回以上">3回以上
          <input class="radio" type="radio" name="face_wash" value="2回" checked>2回
          <input class="radio" type="radio" name="face_wash" value="1回">1回
          <input class="radio" type="radio" name="face_wash" value="なし">なし
        </div>
      </div>

      <div class="skin_status_area">
        <h2 class="skin_status_title">生理</h2>
        <div class="radio_area">
          <input class="radio" type="radio" name="menstruation" value="生理中ではない" checked>生理中ではない
          <input class="radio" type="radio" name="menstruation" value="生理中">生理中
        </div>
      </div>
      <div class="skin_status_area">
        <h2 class="skin_status_title">写真を選択</h2>
        <input type="file" class="file" name="images[]" multiple>
      </div>
      <div class="button_area">
        <button type="submit" class="post" style="margin-bottom: 10px;">投稿</button>
    </div>
    </div>
  </form>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('assets/js/diary.js') }}"></script>

@endsection
