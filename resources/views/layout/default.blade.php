<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/default.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <header>
        <div class="home-box">
            <a class="home-click" href="{{ route('home') }}">ホーム</a>
            <div class="search-box">
                <input type="text" class="search-input"><span class="search-icon">🔍</span>
            </div>
            <select class="genre-box">
                <option value="all">すべて</option>
                @if(session()->has('genreList'))
                    @foreach (session('genreList') as $key => $genre)
                        @if (session('genre') == $genre)
                        <option value="{{ $genre }}" selected>{{ $genre }}</option>
                        @else
                        <option value="{{ $genre }}">{{ $genre }}</option> 
                        @endif            
                    @endforeach
                @endif
            </select>
            <a class="home-click" href="{{ route('item.list') }}">商品一覧</a>
            <a class="home-click" href="{{ route('cart.index') }}">🛒</a>
            <a class="home-click" href="{{ route('history.list') }}">🕐</a>
            <a class="home-click" href="{{ route('favorite.list') }}">♡</a>
        </div>
        {{-- ユーザー情報 --}}
        @if(session()->has('user'))
        <div class="login-box">
            <div class="user-info-main">                
                <div class="home-click user-info">{{ session('user')[0]->name }}さんこんにちは</div>
                <div style="display: none" class="user-info-area">
                    <div class="user-info-box">
                        <div class="user-info-title">アカウントサービス</div>
                        <a href="{{ route('user.toEdit') }}" class="user-info-edit">ユーザー情報修正</a>
                        @if(session()->has('totalPoint'))
                        <div>{{ session('totalPoint') }}ポイント</div>
                        @else
                        <div>0ポイント</div>
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{ Route('user.logOut') }}" class="home-click">ログアウト</a>
        </div>
        @else
        <div class="login-box">
            <a href="{{ Route('user.toLogin') }}" class="home-click">ログイン</a>
            <a href="{{ Route('user.toInsert') }}" class="home-click">新規登録</a>    
        </div>    
        @endif
    </header>
    <main>
        @yield('content')
    </main>
    <script src="/js/default.js"></script>
</body>
</html>