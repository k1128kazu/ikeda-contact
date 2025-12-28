<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'FashionablyLate')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <header class="auth-header">
        <div class="auth-header__title">FashionablyLate</div>

        {{-- 管理画面・認証画面のみ表示 --}}
        @unless (request()->routeIs('contact.*'))
        <div class="auth-header__right">
            @guest
            {{-- Login 画面では「register のみ」表示 --}}
            @if (request()->routeIs('login'))
            <a href="{{ route('register') }}" class="auth-header__link">register</a>
            @endif

            {{-- Register 画面では「login のみ」表示 --}}
            @if (request()->routeIs('register'))
            <a href="{{ route('login') }}" class="auth-header__link">login</a>
            @endif
            @endguest

        </div>
        @endunless
    </header>

    <main class="auth-main">
        @yield('content')
    </main>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>