@extends('layout.default')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="/css/home.css">
@section('content')
{{-- ホーム画像表示 --}}
<div class="home-image-box">
    <div class="left-move">《</div>
    @foreach ($itemRanks as $itemRank)
        @if ($loop->iteration <= 3)
        <img src="{{ asset('/storage/image/'.$itemRank->image) }}" class="home-image">
        @endif
    @endforeach
    <div class="right-move">》</div>
</div>
{{-- 購入数ランキング --}}
<h2>おすすめ</h2>
<div class="rank-list">
    @foreach ($itemRanks as $itemRank)
    <div class="rank-box">
        <div class="rank-view">{{ $loop->iteration }}位</div>
        <div class="rank-image-box">
            <img src="{{ asset('/storage/image/'.$itemRank->image) }}" class="rank-image">
        </div>
        <a href="{{ route('item.detail',['item'=>$itemRank->id]) }}">{{ $itemRank->name }}</a>
        <div>￥{{ $itemRank->price }}</div>
        <div class="rank-word">{{ $itemRank->totalCount }}回購入されています</div>
    </div>
    @endforeach
</div>
<script src="/js/home.js"></script>
@endsection