@extends('layout.default')
<link rel="stylesheet" href="/css/user.css">
@section('content')
<div class="user-area">
    <form action="{{ Route('user.insert') }}" method="post" class="user-box">
        @csrf
        <h1>新規作成</h1>
        <label for="name">名前：</label>
        <input type="text" id="name" name="name">
        <br>
        <label for="mail">メール：</label>
        <input type="text" id="mail" name="mail">
        <br>
        <label for="password">パスワード：</label>
        <input type="text" id="password" name="password">
        <br>
        <label for="address">住所：</label>        
        <input type="text" id="address" name="address">
        <button class="user-btn">新規登録</button>
    </form>
</div>
@endsection