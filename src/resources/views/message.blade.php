@extends('layouts.copy')

@section('content')
<head>
    <link href="{{ asset('assets/css/message.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="message_area">
            <div class="message_title">
                <p class="title">メッセージ 一覧</p>
            </div>
            <div class="message_content_area">
                @foreach($rooms as $room)
                <div class="message_content">
                    @if($room->sender_user_id == Auth::user()->id )
                    <div class="room_user">
                        @if($room->receiver->path)
                        <img src="{{  asset($room->receiver->path) }}" class="room_user_img" alt="プロフィール画像">
                        @else
                        <img src="{{ asset('images/Profile.png') }}" class="room_user_img" alt="プロフィール画像">
                        @endif
                        <a class="user_btn" href="{{ route('message_form', ['userId'=>$room->receiver->id]) }}">
                        <p class="room_user_name">{{ $room->receiver->name }}</p>
                        </a>
                    </div>
                    @endif
                    @if($room->receiver_user_id == Auth::user()->id )
                    <div class="room_user">
                        @if($room->sender->path)
                            <img src="{{  asset($room->sender->path) }}" class="room_user_img" alt="プロフィール画像">
                        @else
                            <img src="{{ asset('images/Profile.png') }}" class="room_user_img" alt="プロフィール画像">
                        @endif
                        <a class="user_btn" href="{{ route('message_form', ['userId'=>$room->sender->id]) }}">
                        <p class="room_user_name">{{ $room->sender->name }}</p>
                        </a>
                    </div>
                    @endif
                    @if($room->LatestMessages)
                    <div class="message_user_area">
                        <p class="message_text">{{ $room->LatestMessages->text }}</p>
                        @if($room->LatestMessages->path)
                        <p class="message_path">画像</p>
                        @endif
                        <div class="message_name_date_area">
                            <p class="message_user_name">{{ $room->LatestMessages->user->name }}</p>
                            <p class="message_date">
                            {{ \Carbon\Carbon::createFromTimeString($room->LatestMessages->updated_at)->format('Y/m/d h:i') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                {{-- foreachで回す限り、ないデータが一つでもあるとエラーがでる --}}
            @endforeach
            </div>
        </div>
    </div>
</body>
<script>
</script>
@endsection
