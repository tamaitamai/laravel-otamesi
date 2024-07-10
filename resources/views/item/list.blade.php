@extends('layout.default')
<link rel="stylesheet" href="/css/item/list.css">
@section('content')
<h2>メインです</h2>
{{-- <h2>{{ session('user')[0]->name }}</h2> --}}
<div class="item-list">
@foreach ($items as $item)
<form action="{{ route('item.add',['item'=>$item->id]) }}" class="item-box">
    <img src="{{ asset('/storage/image/'.$item->image) }}" class="item-image">    
    <a href="{{ route('item.detail',['item' => $item->id]) }}">{{ $item->name }}</a>
    <select name="count" id="">
        @for($i=1; $i<=10; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <div>{{ $item->price }}円</div>
    <button>カート</button>
</form>
@endforeach
</div>
@endsection