@extends('layout.default')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="/css/item/detail.css">
@section('content')
@php
    if(session()->has('user')){
        $userId = session('user')[0]->id;
    }else{
        $userId = 0;
    }
@endphp
<div class="item-area">
    <div class="item-box">
        <img src="{{ asset('/storage/image/'.$item->image) }}" class="item-image">
        <div class="item-info-box">
            <div class="item-name">{{ $item->name }}</div>
            @if($reviews == '[]')
            @include('star.average',['exists'=>false,'averageView'=>false ,'reviews'=>$item->reviews])
            @else
            @include('star.average',['exists'=>false,'averageView'=>true ,'reviews'=>$item->reviews])
            @endif
            <div class="item-price">￥{{ $item->price }}</div> 
            <div>{{ $item->comment }}</div>
        </div>
    </div>
    <form action="{{ route('item.add',['item'=>$item->id]) }}" class="price-box">
        <div class="item-price">￥{{ $item->price }}</div>
        <div class="price-btn-box">
            <select name="count" class="item-count">
                @for($i=1;$i<=10;$i++)
                <option value="{{ $i }}">数量：{{ $i }}</option>
                @endfor
            </select>
            <button class="price-btn">カートに入れる</button>
        </div>
    </form>
</div>
<div class="review-area">
    {{-- レビューの平均を表示 --}}
    <div>
        <h2>カスタマーレビュー</h2>
        @if($reviews == '[]')
        @include('star.average',['exists'=>true,'averageView'=>false ,'reviews'=>$item->reviews])
        @else
        @include('star.average',['exists'=>true,'averageView'=>true ,'reviews'=>$item->reviews])
        @endif
        <a href="{{ route('review',['itemId'=> $item->id]) }}">レビューを投稿/編集</a>
    </div>
    {{-- レビュー一覧を表示 --}}
    <div class="review-list">
        <h2>レビュー</h2>
        @foreach ($reviews as $review)
        <div class="review-box">
            <div class="review-name">👤{{ $review->name }}さん</div>
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
            @if ($review->rgUserId === $userId)
            <button class="review-good" value="{{ $review->id }}" style="border: 1px solid red">役に立った</button>
            @elseif ($userId === 0)
            <form action="{{ Route('user.toLogin') }}">
                <button class="review-good-logout">役に立った</button>
            </form>
            @else
            <button class="review-good" value="{{ $review->id }}">役に立った</button>
            @endif
            <div><span class="review-total-count">{{ $review->totalCount }}</span>人が役にたったと言っています</div>
        </div>
        @endforeach
    </div>
</div>
<script src="/js/review.js"></script>
@endsection
