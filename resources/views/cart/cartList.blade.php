@extends('layout.default')
<link rel="stylesheet" href="/css/cart.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@section('content')
<div class="cart-main">
    {{-- カート一覧 --}}   
    <div class="cart-area">
        <div class="cart-list">
            <h2 class="cart-title">ショッピングカート</h2>
            @if($carts == '[]')
            <div class="cart-empty">カートが空です</div>
            @endif
            @foreach ($carts as $cart)
            <div class="cart-box">            
                <img src="{{ asset('/storage/image/'.$cart->image) }}" class="cart-image">
                <div class="cart-info-box">
                    <div class="cart-top-box">
                        <a href="{{ route('item.detail',['item'=>$cart->item_id]) }}" class="cart-name">{{ $cart->name }}</a>
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
                            <a href="{{ route('cart.after',['cartId'=>$cart->id]) }}" class="cart-after-btn">あとで買う</a>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{-- あとで買うで選択した一覧 --}}
        <div class="cart-after-area">
            <h2 class="cart-after-title">商品</h2>
            @if($cartsByAfter == '[]')
            <div class="cart-empty">あとで買うに選択した商品がありません</div>
            @endif
            <div class="cart-after-list">
                @foreach ($cartsByAfter as $cart)
                <div class="cart-after-box">
                    <div class="cart-after-image-box">
                        <img src="{{ asset('/storage/image/'.$cart->image) }}" class="cart-after-image">
                    </div>
                    <div class="cart-after-info-box">
                        <a href="{{ route('item.detail',['item'=>$cart->item_id]) }}">{{ $cart->name }}</a>
                        <div>￥{{ $cart->price }}</div>    
                    </div>
                    <form action="{{ route('cart.return',['cartId'=>$cart->id]) }}" class="cart-return-btn-box">
                        <button class="cart-return-btn">カートに戻す</button>
                    </form>
                    <form action="{{ Route('cart.destroy',['id'=>$cart->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button style="margin-left: 10px" class="cart-delete-btn">削除</button>
                    </form>
                </div>
                @endforeach        
            </div>    
        </div>
    </div>
    {{-- 金額詳細 --}}
    <form class="cart-price-box" action="{{ route('order.confirm') }}">
        <div class="cart-total-title">小計({{ $totalCount }}個の商品)</div>
        <div class="cart-total-price">￥{{ $totalPrice }}</div>
        <div>{{ $totalPrice/100 }}ポイント獲得予定</div>
        <div>{{ session('totalPoint') }}ポイント利用可能</div>
        <div class="cart-buy-btn-area">
            <button class="cart-buy-btn">注文確認</button>
            {{-- <a href="{{ route('order.confirm') }}">注文確認</a> --}}
        </div>
    </form>
</div>
<script src="/js/cart.js"></script>
@endsection
