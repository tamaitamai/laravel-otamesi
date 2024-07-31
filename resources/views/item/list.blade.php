@extends('layout.default')
<link rel="stylesheet" href="/css/item/list.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@section('content')
@php
    if(session()->has('searchItems')){
        $items = session('searchItems');
    }
@endphp
<div class="item-list">
@foreach ($items as $item)
<form action="{{ route('item.add',['item'=>$item->id]) }}" class="item-box cart-add-box">
    <div class="item-image-area">
        <img src="{{ asset('/storage/image/'.$item->image) }}" class="item-image">    
    </div>
    <a href="{{ route('item.detail',['item' => $item->id]) }}">{{ $item->name }}</a>
    @if($item->reviews == '[]')
    @include('star.average',['exists'=>false,'averageView'=>false ,'reviews'=>$item->reviews])
    @else
    @include('star.average',['exists'=>false,'averageView'=>true ,'reviews'=>$item->reviews])
    @endif
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
{{-- カート追加表示モーダル --}}
@include('modal.cartAdd')
@endsection