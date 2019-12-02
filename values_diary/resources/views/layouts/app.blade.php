<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css" />

    @yield('css')

</head>
<body>
    <div id="app">
        <nav class="uk-navbar-container uk-margin" uk-navbar>
            @auth
                <div class="uk-navbar-left">
                    <a class="uk-navbar-item uk-logo" href="{{ route('home') }}">
                        @if (Auth::user()->profile_image)
                            <img src="/storage/images/{{ Auth::user()->profile_image }}" width="50px" height="50px" alt="avatar" style="border-radius: 50%; margin: 15px">

                        @endif
                        {{ Auth::user()->name }}の価値観日記
                    </a>
                </div>
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="{{ route('about') }}" >
                                <span class="uk-icon uk-margin-small-right" uk-icon="info"></span>
                                価値観日記とは
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('posts.index') }}" >
                                <span class="uk-icon uk-margin-small-right" uk-icon="album"></span>
                                日記
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('values.index') }}" >
                                <span class="uk-icon uk-margin-small-right" uk-icon="list"></span>
                                <!-- fontawsomeのグラフアイコンを使う -->
                                価値観
                            </a>
                        </li>
                        <li>
                            <a href="" >
                                <span class="uk-icon uk-margin-small-right" uk-icon="star"></span>
                                グラフ
                            </a>
                        </li>
                        <li>
                            <a href="/users/{{ Auth::id() }}">
                                <span class="uk-icon uk-margin-small-right" uk-icon="user"></span>
                                プロフィール
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <span class="uk-icon uk-margin-small-right" uk-icon="sign-out"></span>
                                ログアウト
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="uk-navbar-left">
                    <a class="uk-navbar-item uk-logo" href="/">
                        価値観日記
                    </a>
                </div>
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="{{ route('login') }}">
                                <span class="uk-icon uk-margin-small-right" uk-icon="sign-in"></span>
                                ログイン
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}">
                                    <span class="uk-icon uk-margin-small-right" uk-icon="plus"></span>
                                    新規登録
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endauth
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('scripts')

</body>
</html>
