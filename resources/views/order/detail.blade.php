@extends('layout.default')
<link rel="stylesheet" href="/css/order/detail.css">
@section('content')
@php
    $user = session('user')[0];
@endphp
<h1>注文詳細</h1>
<div class="order-date-box">
    <div>注文日：{{ $history->created_at->format('Y年m月d日') }}</div>
</div>

<div class="order-detail-box">
    <div class="order-detail-top-box">
        <div>お届け先住所</div>
        <div>{{ $user->name }}</div>
        <div>{{ $user->address }}</div>
    </div>
    <div class="order-detail-bottom-box">
        <div>合計</div>
        <div>￥{{ $history->price * $history->count }}</div>
    </div>
</div>


<div class="history-box">
    <div class="history-top-box">
        <div class="history-order-date">{{ $history->order_date->format('Y年m月d日') }}に配達しました</div>
        <a href="{{ route('order.delivery',['historyId'=>$history->id]) }}" class="history-delivery-check">発送状況の確認</a>
    </div>
    <div class="history-bottom-box">
        <div class="history-bottom-left-box">
            <img src="{{ asset('/storage/image/'.$history->image) }}" class="history-image">
            <div class="history-count">{{ $history->count }}</div>
            <a href="{{ route('item.detail',['item'=>$history->item_id]) }}" class="history-name">{{ $history->name }}</a>
        </div>
        <div class="history-bottom-right-box">
            <a href="{{ route('review',['itemId'=>$history->item_id]) }}" class="history-review">レビューの投稿/編集</a>
        </div>
    </div>
</div>
@endsection