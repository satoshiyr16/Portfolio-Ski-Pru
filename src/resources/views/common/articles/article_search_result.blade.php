<div class="article_area row">
    @foreach ($articleResults as $articleResult)
        <div class="article_content_area col-md-4">
            @if(isset( $articleResult->path ))
                <img class="img" src="{{ asset($articleResult->path) }}">
            @else
                <img class="img" src="{{ asset('images/article.jpg') }}">
            @endif
            <a class="article_view" href="{{ route('article_view',['id'=>$articleResult->id]) }}">
                <p class="title">{{ $articleResult->title }}</p>
            </a>
            <div class="article_information_area">
                <p class="like_count"><i class="fas fa-heart fa-lg like"></i>{{$articleResult->likes_count}}</p>
                <div class="name_date_area">
                    <p class="user_name">{{ $articleResult->user_name }}</p>
                    <p class="date">{{ \Carbon\Carbon::createFromTimeString($articleResult->updated_at)->format('Y/m/d')}}</p>
                </div>
            </div>
        </div>
    @endforeach
    <div class="pagination">
        {!! $articleResults->appends(request()->input())->links('pagination::bootstrap-4') !!}
    </div>
</div>
