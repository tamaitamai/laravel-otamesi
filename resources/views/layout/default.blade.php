<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="home-box">
            <a href="{{ route('home') }}">ホーム</a>
            <input type="text" class="search-box">
            <a href="{{ route('item.list') }}">商品一覧</a>
            <a href="{{ route('cart.index') }}">🛒</a>
            <a href="{{ route('history.list') }}">🕐</a>
        </div>
        @if(session()->has('user'))
        <div class="login-box">
            <div>{{ session('user')[0]->name }}さんこんにちは</div>
            <a href="{{ Route('user.logOut') }}">ログアウト</a>
        </div>
        @else
        <div class="login-box">
            <a href="{{ Route('user.toLogin') }}">ログイン</a>
            <a href="{{ Route('user.toInsert') }}">新規登録</a>    
        </div>    
        @endif
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
<style>
header{
    border: 1px solid black;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 10px;
}
.home-box{
    
}
.search-box{
    font-size: 20px;
}
.login-box{
    display: flex;
    justify-content: end;
    align-items: center;
    flex-direction: column;
    padding: 20px;
}

</style>