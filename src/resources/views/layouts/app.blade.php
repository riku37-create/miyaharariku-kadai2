<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <script src="https://kit.fontawesome.com/0f5967e132.js" crossorigin="anonymous"></script>{{--アイコン--}}
</head>
<body>
    <header class="header">
        <div class="header-title">mogitate</div>
    </header>
    <main>
        <div class="content">
            @yield('content')
        </div>
    </main>
</body>
</html>