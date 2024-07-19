@extends('layout.default')
<link rel="stylesheet" href="/css/user.css">
@section('content')
<div class="user-area">
    <form action="{{ Route('user.login') }}" method="post" class="user-box">
        @csrf
        <h1>ログイン</h1>
        <label for="mail">メール：</label>
        <input type="text" id="mail" name="mail" value="{{ old('mail') }}">
        @if ($errors->has('mail'))
            <div style="color:red">{{ $errors->get('mail')[0] }}</div>
        @endif
        <br>
        <label for="password">パスワード：</label>
        <input type="password" id="password" name="password">
        @if ($errors->has('password'))
            <div style="color:red">{{ $errors->get('password')[0] }}</div>
        @endif        
        <button class="user-btn">ログイン</button>
    </form>
</div>
@endsection