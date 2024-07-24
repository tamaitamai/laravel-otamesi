@extends('layout.default')
<link rel="stylesheet" href="/css/order/delivery.css">
@section('content')
@php
    $user = session('user')[0]
@endphp
<div class="delivery-area">
    <div class="delivery-box">
        <div class="delivery-top-box">
            <div>{{ $history->order_date->format('y年m月d日') }}にお届け済み</div>
            <img src="{{ asset('/storage/image/'.$history->image) }}" class="delivery-image">
        </div>
        <div class="delivery-bottom-box">
            <div class="address-box">
                <h3>お届け先住所</h3>
                <div>{{ $user->name }}</div>
                <div>{{ $user->address }}</div>
            </div>  
            <div class="detail-box">
                <h3>注文情報</h3>
                <a href="{{ route('order.detail',['historyId'=>$history->id]) }}">注文情報</a>
            </div>
        </div>
    </div>
</div>
@endsection