<div class="search_area">
    <form method="GET" action="{{ route( $searchRoute ) }}">
        <h3 class="search_title">{{ $searchType }}</h3>
        <div class="input_area">
            <input type="text" class="word" name={{ $inputName }} placeholder={{ $placeholder }}>
        </div>
        <div class="btn_area">
            <button type="submit" class="search_btn">検索</button>
        </div>
    </form>
    <div class="search_change_area">
        <a href="{{ route( $changeSearchRoute ) }}" class="search_change">{{ $changeSearchType }}　→</a>
    </div>
</div>
