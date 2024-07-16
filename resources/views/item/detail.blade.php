@extends('layout.default')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="/css/item/detail.css">
@section('content')
<h2>アイテム詳細</h2>    
<div>{{ $item->name }}</div>
@include('star.average',['exists'=>false])
<img src="{{ asset('/storage/image/'.$item->image) }}" class="item-image">
<a href="{{ route('review',['itemId'=> $item->id]) }}">レビューを書く</a>
@include('star.average',['exists'=>true])
{{-- レビュー一覧を表示 --}}
<div class="review-list">
    <h1>レビュー</h1>
    @foreach ($reviews as $review)
    <div class="review-box">
        <div class="review-name">{{ $review->name }}さん</div>
        <div class="review-comment">{{ $review->comment }}</div>
        <div>
            @for ($i=1; $i<=5; $i++)
                @if($i <= $review->star)
                <span style="font-size: 20px; color: orange;">★</span>
                @else
                <span style="font-size: 20px;">☆</span>
                @endif
            @endfor
        </div>
        @if ($review->rgUserId === session('user')[0]->id)
        <button class="review-good" value="{{ $review->id }}" style="border: 1px solid red">役に立った</button>
        @else
        <button class="review-good" value="{{ $review->id }}">役に立った</button>
        @endif
        <div><span class="review-total-count">{{ $review->totalCount }}</span>人が役にたったと言っています</div>
    </div>
    @endforeach
</div>
<script src="/js/review.js"></script>
@endsection
