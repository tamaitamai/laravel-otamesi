@extends('layout.default')
<link rel="stylesheet" href="/css/user.css">
@section('content')
@php
    $user = session('user')[0];
@endphp
<div class="user-area">
    <form action="{{ Route('user.edit') }}" method="post" class="user-box">
        @csrf
        <h1>ユーザー情報更新</h1>
        <label for="name">名前：</label>
        <input type="text" id="name" name="name" value={{ $user->name }}>
        <br>
        <label for="mail">メール：</label>
        <input type="text" id="mail" name="mail" value={{ $user->mail }}>
        <br>
        <label for="password">パスワード：</label>
        <input type="text" id="password" name="password" value={{ $user->password }}>
        <br>
        <label for="address">住所：</label>
        <input type="text" id="address" name="address" value={{ $user->address }}>
        <br>
        <button class="user-btn">ユーザー情報更新</button>
    </form>
</div>
@endsection