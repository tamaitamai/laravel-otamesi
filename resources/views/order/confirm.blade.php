@extends('layout.default')
<link rel="stylesheet" href="/css/order/confirm.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@section('content')
<form action="{{ route('order.payment') }}" method="POST" class="order-area">
    @csrf
    <?php $user=session('user')[0] ?>
    <div class="order-box">
        {{-- 送付先住所 --}}
        <div class="address-box">
            <div>{{ $user->name }}さん</div>
            <div>{{ $user->address }}にお届け</div>
        </div>
        {{-- カート一覧 --}}
        <div class="cart-list">
            @foreach ($carts as $cart)
            <div class="delivery-date">発送日：<span class="delivery-date-text"></span></div>
            <div class="cart-box">
                <div>
                    <div class="cart-info-area">
                        <img src="{{ asset('/storage/image/'.$cart->image) }}" class="cart-image">    
                        <div class="cart-info-box">
                            <div>{{ $cart->name }}</div>
                            <div>￥{{ $cart->price }}</div>
                            <div>{{ $cart->count }}個</div>
                        </div>
                    </div>
                </div>
                <div class="cart-date-box">
                    <div>お急ぎ便：</div>
                    <div class="tomorrow-check">
                        <input type="radio" id="{{ 'tomorrow'.$cart->id }}" name="{{ 'order_date'.$cart->id }}" class="tomorrow-value" checked>
                        <label for="{{ 'tomorrow'.$cart->id }}">明日</label>
                    </div>
                    <br>
                    <div class="select-date-check">
                        <input type="radio" id="{{ 'select_date'.$cart->id }}" class="select-date-value" name="{{ 'order_date'.$cart->id }}">
                        <label for="{{ 'select_date'.$cart->id }}">時間指定</label>
                    </div>
                </div>    
            </div>
            @endforeach
        </div>
    </div>
    {{-- 価格情報 --}}
    <div class="cart-price-box">
        <div class="cart-total-title">小計({{ $totalCount }}個の商品)</div>
        <div class="cart-total-price">￥{{ $totalPrice }}</div>
        <div class="cart-point-box">
            <div>利用ポイント：</div>
            <input type="hidden" class="cart-total-value" value="{{ $totalPrice }}">
            <input type="text" name="point" class="cart-point-value" value="{{ session('totalPoint') }}">
        </div>
        <div>支払い額：￥<span class="result-price"></span></div>
        <div class="cart-get-point">獲得ポイント：{{ $totalPrice/100 }}</div>
        <div class="cart-buy-btn-area">
            <button class="cart-buy-btn">購入確定</button>
        </div>
    </div>
</form>
{{-- 日付選択モーダル --}}
<div class="select-date-area">
    <input type="hidden" class="select-date-num">
    <div class="select-date-box">
        <div>日付を選択</div>
        <input type="date" class="select-date-change">
        <button class="select-date-btn">確定</button>
    </div>
</div>
<script src="/js/order/confirm.js"></script>
<script src="/js/form.js"></script>
@endsection