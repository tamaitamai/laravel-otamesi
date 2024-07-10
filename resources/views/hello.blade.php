<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Hello</h1>
    <h2>初めまして</h2>
    @foreach ($items as $item)
    <div>{{ $item->name }}</div>
    <div>{{ $item->comment }}</div>
    @endforeach
</body>
</html>