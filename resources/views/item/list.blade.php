@extends('layout.default')
<link rel="stylesheet" href="/css/item/list.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@section('content')
<div class="item-list">
@foreach ($items as $item)
<form action="{{ route('item.add',['item'=>$item->id]) }}" class="item-box">
    <div class="item-image-area">
        <img src="{{ asset('/storage/image/'.$item->image) }}" class="item-image">    
    </div>
    <a href="{{ route('item.detail',['item' => $item->id]) }}">{{ $item->name }}</a>
    <select name="count" class="item-count">
        @for($i=1; $i<=10; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <div class="item-price">￥{{ $item->price }}</div>
    <button class="item-add-btn">カート</button>
</form>
@endforeach
</div>
<div class="item-add-area">
    <div class="item-add-box">
        <h2>カートに商品を入れました</h2>
        <button class="close-btn">買い物を続ける</button>
    </div>    
</div>
<script src="/js/item/list.js"></script>
@endsection