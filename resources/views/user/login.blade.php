@extends('layout.default')
<link rel="stylesheet" href="/css/user.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@section('content')
<div class="user-area">
    @if(session()->has('noUser'))
    <div class="no-user-box">
        <div class="no-user">{{ session('noUser') }}</div>
    </div>
    @endif
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
<script src="/js/form.js"></script>
@endsection