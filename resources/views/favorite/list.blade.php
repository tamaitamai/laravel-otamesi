@extends('layout.default')
<link rel="stylesheet" href="/css/favorite/list.css">
@section('content')
<div class="favorite-main">
    {{-- 絞り込み --}}
    <div class="favorite-genre-list">
        <div class="favorite-genre-title">絞り込み</div>
        <form action="{{ route('favorite.genre') }}" class="favorite-genre-box" method="POST">
            @csrf
            <div class="favorite-genre-info-box">
                <div>カテゴリ</div>
                <div class="favorite-genre-select">
                    @foreach (session('favoriteGenreList') as $key => $genre)
                    @if (session('selectGenres') && in_array($genre, session('selectGenres')))
                        <input type="checkbox" id="{{ $genre }}" name="genre[]" value="{{ $genre }}" checked>
                    @else
                        <input type="checkbox" id="{{ $genre }}" name="genre[]" value="{{ $genre }}">
                    @endif
                    <label for="{{ $genre }}">{{ $genre }}</label>
                    @endforeach
                </div>
            </div>
            <div class="favorite-genre-btn-box">
                <button class="favorite-genre-btn">絞り込む</button>
                <button class="favorite-reset-btn" value="true" name="reset">条件を解除</button>
            </div>
        </form>
    </div>

    {{-- お気に入り一覧 --}}
    <div class="favorite-area">
        <div class="favorite-total-count">全{{ count($favorites) }}件</div>
        <div class="favorite-list">
        @foreach ($favorites as $favorite)
            <div class="favorite-box">
                <img src="{{ asset('/storage/image/'.$favorite->image) }}" class="favorite-image">
                <a href="{{ route('item.detail',['item'=>$favorite->item_id]) }}">{{ $favorite->name }}</a>
                <div class="favorite-price">￥{{ $favorite->price }}</div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection