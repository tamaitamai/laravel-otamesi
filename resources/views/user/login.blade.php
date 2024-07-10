@extends('layout.default')
<link rel="stylesheet" href="/css/user.css">
@section('content')
<div class="user-area">
    <form action="{{ Route('user.login') }}" method="post" class="user-box">
        @csrf
        <h1>ログイン</h1>
        <label for="mail">メール：</label>
        <input type="text" id="mail" name="mail">
        <br>
        <label for="password">パスワード：</label>
        <input type="text" id="password" name="password">
        <button class="user-btn">ログイン</button>
    </form>
</div>
@endsection