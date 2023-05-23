@extends('layouts.copy')

@section('content')
<head>
  <link href="{{ asset('assets/css/diary.css') }}" rel="stylesheet">
  <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<div class="container">
  <div class="calendar_date_area">
  <form action="{{ route('skin_diary_update',['date'=>$date]) }}" method="POST" enctype="multipart/form-data">
  @csrf
    <div class="date_title_area_editver">
      <div class="title_area">
        <h1 class="date_title">{{ $date }}</h1>
        <p class="edit">の編集</p>
      </div>
      <div class="skin_tone_area">
        <h2 class="skin_tone_title">肌の調子</h2>
        <select class="skin_tone" name="skin_tone">
          <option name="skin_tone" value="良い" {{ $skin_diary->skin_tone == '良い' ? 'selected' : '' }}>良い</option>
          <option name="skin_tone" value="少し良い" {{ $skin_diary->skin_tone == '少し良い' ? 'selected' : '' }}>少し良い</option>
          <option name="skin_tone" value="普通" {{ $skin_diary->skin_tone == '普通' ? 'selected' : '' }}>普通</option>
          <option name="skin_tone" value="少し悪い" {{ $skin_diary->skin_tone == '少し悪い' ? 'selected' : '' }}>少し悪い</option>
          <option name="skin_tone" value="悪い" {{ $skin_diary->skin_tone == '悪い' ? 'selected' : '' }}>悪い</option>
        </select>
      </div>
    </div>
    <div class="calendar_date_content">
      <div class="skin_status_area">
        <h3 class="skin_status_title">肌状態</h3>
        <div class="radio_area">
          <input class="radio" type="radio" name="skin_status" value="特にない" {{ $skin_diary->skin_status === '特にない' ? 'checked' : '' }}>特にない
          <input class="radio" type="radio" name="skin_status" value="ベタベタする" {{ $skin_diary->skin_status === 'ベタベタする' ? 'checked' : '' }}>ベタベタする
          <input class="radio" type="radio" name="skin_status" value="乾燥" {{ $skin_diary->skin_status === '乾燥' ? 'checked' : '' }}>乾燥
          <input class="radio" type="radio" name="skin_status" value="肌荒れ" {{ $skin_diary->skin_status === '肌荒れ' ? 'checked' : '' }}>肌荒れ
        </div>
        @if($skin_diary->skin_status_text)
          <textarea class="status_text" placeholder="{{ $skin_diary->skin_status_text }}" id="" name="skin_status_text"></textarea>
        @else
          <textarea class="status_text" placeholder="肌の詳しい状態（例：痒みなど）" id="" name="skin_status_text"></textarea>
        @endif
      </div>
      <div class="skin_status_area">
        <h3 class="skin_status_title">ニキビ</h3>
        <div class="radio_area">
          <input class="radio" type="radio" name="acne" value="ない" {{ $skin_diary->acne === 'ない' ? 'checked' : '' }}>ない
          <input class="radio" type="radio" name="acne" value="少しある" {{ $skin_diary->acne === '少しある' ? 'checked' : '' }}>少しある
          <input class="radio" type="radio" name="acne" value="ある" {{ $skin_diary->acne === 'ある' ? 'checked' : '' }}>ある
        </div>
        @if($skin_diary->acne_status_text)
          <textarea class="status_text" placeholder="{{ $skin_diary->acne_status_text }}" id="" name="acne_status_text"></textarea>
        @else
          <textarea class="status_text" placeholder="ニキビの詳しい状態（例：位置や色味など）" id="" name="acne_status_text"></textarea>
        @endif
      </div>
      <div class="skin_status_area">
        <h2 class="skin_status_title">食事</h2>
        <div class="radio_area">
          <input class="radio" type="radio" name="food" value="バランス良い" {{ $skin_diary->food === 'バランス良い' ? 'checked' : '' }}>バランス良い
          <input class="radio" type="radio" name="food" value="普通" {{ $skin_diary->food === '普通' ? 'checked' : '' }}>普通
          <input class="radio" type="radio" name="food" value="バランス悪い" {{ $skin_diary->food === 'バランス悪い' ? 'checked' : '' }}>バランス悪い
        </div>
        @if($skin_diary->food_content_text)
          <textarea class="status_text" placeholder="{{ $skin_diary->food_content_text }}" id="" name="food_content_text"></textarea>
        @else
          <textarea class="status_text" placeholder="食事の詳しい詳細（例：食事内容など）" id="" name="food_content_text"></textarea>
        @endif
      </div>

      <div class="skin_status_area">
        <h2 class="skin_status_title">スキンケア</h2>
        <div class="radio_area">
          <input class="radio" type="radio" name="skincare" value="した" {{ $skin_diary->skincare === 'した' ? 'checked' : '' }}>した
          <input class="radio" type="radio" name="skincare" value="してない" {{ $skin_diary->skincare === 'してない' ? 'checked' : '' }}>してない
        </div>
        @if($skin_diary->skincare_content_text)
          <textarea class="status_text" placeholder="{{ $skin_diary->skincare_content_text }}" id="" name="skincare_content_text"></textarea>
        @else
          <textarea class="status_text" placeholder="スキンケアの詳しい詳細（例：使った道具など）" id="" name="skincare_content_text"></textarea>
        @endif
      </div>

      <div class="skin_status_area">
        <h2 class="skin_status_title">睡眠</h2>
        <div class="radio_second_area">
          <input class="radio" type="radio" name="sleep" value="9h以上" {{ $skin_diary->sleep === '9h以上' ? 'checked' : '' }}>9h以上
          <input class="radio" type="radio" name="sleep" value="9~6時間" {{ $skin_diary->sleep === '9~6時間' ? 'checked' : '' }}>9〜6時間
          <input class="radio" type="radio" name="sleep" value="6~3時間" {{ $skin_diary->sleep === '6~3時間' ? 'checked' : '' }}>6〜3時間
          <input class="radio" type="radio" name="sleep" value="3~0時間" {{ $skin_diary->sleep === '3~0時間' ? 'checked' : '' }}>3〜0時間
        </div>
      </div>

      <div class="skin_status_area">
        <h2 class="skin_status_title">排便</h2>
        <div class="radio_second_area">
          <input class="radio" type="radio" name="defecation" value="快便" {{ $skin_diary->defecation === '快便' ? 'checked' : '' }}>快便
          <input class="radio" type="radio" name="defecation" value="普通" {{ $skin_diary->defecation === '普通' ? 'checked' : '' }}>普通
          <input class="radio" type="radio" name="defecation" value="便秘" {{ $skin_diary->defecation === '便秘' ? 'checked' : '' }}>便秘
          <input class="radio" type="radio" name="defecation" value="下痢" {{ $skin_diary->defecation === '下痢' ? 'checked' : '' }}>下痢
        </div>
      </div>

      <div class="skin_status_area">
        <h2 class="skin_status_title">洗顔</h2>
        <div class="radio_area">
          <input class="radio" type="radio" name="face_wash" value="3回以上" {{ $skin_diary->face_wash === '3回以上' ? 'checked' : '' }}>3回以上
          <input class="radio" type="radio" name="face_wash" value="2回" {{ $skin_diary->face_wash === '2回' ? 'checked' : '' }}>2回
          <input class="radio" type="radio" name="face_wash" value="1回" {{ $skin_diary->face_wash === '1回' ? 'checked' : '' }}>1回
          <input class="radio" type="radio" name="face_wash" value="なし" {{ $skin_diary->face_wash === 'なし' ? 'checked' : '' }}>なし
        </div>
      </div>

      <div class="skin_status_area">
        <h2 class="skin_status_title">生理</h2>
        <div class="radio_area">
          <input class="radio" type="radio" name="menstruation" value="生理中ではない" {{ $skin_diary->menstruation === '生理中ではない' ? 'checked' : '' }}>生理中ではない
          <input class="radio" type="radio" name="menstruation" value="生理中" {{ $skin_diary->menstruation === '生理中' ? 'checked' : '' }}>生理中
        </div>
      </div>
      <div class="skin_status_area">
        <h2 class="skin_status_title">写真を選択</h2>
          @if($images)
          <div class="img_area">
              @foreach ($images as $image)
              <div class="image-preview" data-image-id="{{ $image->id }}">
                  <img src="{{ asset($image->path) }}" alt="image" style="width: 100px; height:100px; margin:0 10px;">
                  <button type="button" class="btn btn-danger btn-sm remove-image">削除</button>
              </div>
              @endforeach
          </div>
          @endif
          <input type="file" class="file" name="images[]" multiple>
      </div>
      <div class="button_area">
        <button type="submit" class="post">投稿</button>
      </div>
    </div>
  </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/diary_edit.js') }}"></script>
@endsection
