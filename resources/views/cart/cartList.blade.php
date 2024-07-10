@extends('layout.default')
<link rel="stylesheet" href="/css/cart.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@section('content')
<div class="cart-area">
    <div class="cart-list">
        <h1>カートの中身</h1>
        @foreach ($carts as $cart)
        <div class="cart-box">            
            <img src="{{ asset('/storage/image/'.$cart->image) }}" class="cart-image">
            <div class="cart-info-box">
                <div class="cart-top-box">
                    <div class="cart-name">{{ $cart->name }}</div>
                    <div class="cart-price">￥{{ $cart->price }}</div>
                </div>
                <div class="cart-bottom-box">
                    <form id="countForm" action="{{ route('cart.update',['cart'=>$cart->id]) }}" method="POST">
                        @csrf
                        <select name="count" class="cart-count" onchange="this.form.submit()">
                            @for($i=1; $i<=10; $i++)
                                @if($i == $cart->count)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                @else
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                    </form>
                    <form action="{{ Route('cart.destroy',['id'=>$cart->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="cart-delete-btn">削除</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <form class="cart-price-box" action="{{ route('cart.payment') }}" method="POST">
        @csrf
        <div class="cart-total-title">小計({{ $totalCount }}個の商品)</div>
        <div class="cart-total-price">￥{{ $totalPrice }}</div>
        <div class="cart-buy-btn-area">
            <button class="cart-buy-btn">購入確定</button>
        </div>
    </form>
</div>
<script src="/js/cart.js"></script>
@endsection
