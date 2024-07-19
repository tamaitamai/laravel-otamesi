@extends('layout.default')
<link rel="stylesheet" href="/css/user.css">
@section('content')
<div class="user-area">
    <form action="{{ Route('user.insert') }}" method="post" class="user-box">
        @csrf
        <h1>新規作成</h1>
        
        <label for="name">名前：</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @if ($errors->has('name'))
        <div style="color:red">{{ $errors->get('name')[0] }}</div>
        @endif
        <br>

        <label for="mail">メール：</label>
        <input type="text" id="mail" name="mail" value="{{ old('mail') }}">
        @if ($errors->has('mail'))
        <div style="color:red">{{ $errors->get('mail')[0] }}</div>
        @endif
        <br>

        <label for="password">パスワード：</label>
        <input type="text" id="password" name="password">
        @if ($errors->has('password'))
        <div style="color:red">{{ $errors->get('password')[0] }}</div>
        @endif
        <br>

        <label for="address">住所：</label>        
        <input type="text" id="address" name="address" value="{{ old('address') }}">
        @if ($errors->has('address'))
        <div style="color:red">{{ $errors->get('address')[0] }}</div>
        @endif
        <button class="user-btn">新規登録</button>
    </form>
</div>
@endsection