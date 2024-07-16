@extends('layout.default')
<link rel="stylesheet" href="/css/history/list.css">
@section('content')
<h1>履歴</h1>
<div class="history-area">
    @foreach ($historys as $history)
    <div class="history-box">
        <div class="history-top-box">
            <div class="history-top-left-box">
                <div>注文日</div>
                <div>{{ $history->created_at }}</div>
            </div>
            <div class="history-top-right-box">
                <div>合計</div>
                <div>￥{{ $history->price * $history->count }}</div>    
            </div>
        </div>
        <div class="history-bottom-box">
            <div class="history-bottom-left-box">
                <img src="{{ asset('/storage/image/'.$history->image) }}" class="history-image">
                <a href="{{ route('item.detail',['item'=>$history->item_id]) }}" class="history-name">{{ $history->name }}</a>
            </div>
            <div class="history-bottom-right-box">
                <a href="{{ route('review',['itemId'=>$history->item_id]) }}">レビューの投稿/編集</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection