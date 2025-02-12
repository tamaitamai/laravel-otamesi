@extends('layout.default')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@section('content')
<?php
$edit = '投稿';
$name = '';
$comment = '';
$star = '';
if($review != '[]'){
    $name = $review[0]->name;
    $comment = $review[0]->comment;
    $star = $review[0]->star;
    $edit = '編集';
}
?>
@if($review == '[]')
<form action="{{ Route('review.add') }}" method="post" class="review-area">
@else
<form action="{{ Route('review.edit') }}" method="post" class="review-area">
@endif
    @csrf
    <div class="review-box">
        <h1>レビュー{{ $edit }}</h1>
        名前：<input type="text" name="name" value={{ $name }}>
        コメント：<textarea name="comment">{{ $comment }}</textarea>
        <div>
            <span class="star">☆</span>
            <span class="star">☆</span>
            <span class="star">☆</span>
            <span class="star">☆</span>
            <span class="star">☆</span>
        </div>
        <input type="hidden" class="star-value" name="star" value={{ $star }}>
        <button name="item_id" value="{{ $itemId }}">{{ $edit }}</button>
    </div>
</form>
<script src="/js/review.js"></script>
@endsection
<style>
.review-area,.review-box{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
.review-box{
    border: 1px solid black;
    width: 50%;
    border-radius: 10px;
    margin-top: 50px;
}
.star{
    font-size: 20px;
}
</style>
