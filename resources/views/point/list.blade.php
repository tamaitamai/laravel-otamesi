@extends('layout.default')
<link rel="stylesheet" href="/css/point/list.css">
@section('content')
{{-- 合計ポイント --}}
<div class="total-point-area">
    <div class="total-point-list">
        <div class="total-point-title">ポイント残高</div>
        <div class="total-point-box">
            <div class="total-point-view">
                <div>ご利用可能ポイント：</div>
                <div>{{ session('totalPoint') }}</div>
            </div>
            {{-- 限定ポイント --}}
            <div class="total-limit-point-view">
                <div class="normal-point-box">
                    <div>通常ポイント：</div>
                    <div>{{ session('totalPoint') }}</div>
                </div>
                <div class="limit-point-box">
                    <div>限定ポイント：</div>
                    <div>0</div>
                </div>
            </div>
        </div>        
    </div>
</div>
{{-- ポイント一覧 --}}
<div class="point-area">    
    <div class="point-title">ポイント履歴</div>
    <div class="point-list">
        @foreach ($points as $point)
            <div class="point-box">
                <div class="point-info">
                    <div>{{ $point->created_at->format('y年m月d日') }}</div>
                    <div class="point-name">{{ $point->name }}</div>
                    @if($point->item_id)
                        <a href="{{ route('item.detail',['item'=>$point->item_id]) }}">商品詳細</a>
                    @endif
                </div>
                <div class="point-info-second">
                    @if($point->point < 0)
                        <div class="use-point">利用</div>
                    @else
                        <div class="get-point">獲得ポイント</div>
                    @endif    
                    <div>{{ $point->point }}</div>
                </div>
            </div>
        @endforeach
    </div>    
</div>
@endsection