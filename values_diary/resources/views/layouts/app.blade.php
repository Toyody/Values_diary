<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css" />

    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- ページ遷移時にレイアウトが一瞬崩れる現象対策。load後にfadeInさせる -->
    <style>
        #app {
            display:none;
        }
    </style>

    @yield('css')

</head>
<body>
    <div id="app">
        <header>
            <!-- スマホ環境時のナビバー -->
            <nav class="uk-navbar-container uk-margin uk-hidden@s" uk-navbar>

                @auth
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-item uk-logo" href="{{ route('home') }}">
                            @if (Auth::user()->profile_image)
                                <img src="/storage/images/{{ Auth::user()->profile_image }}" width="50px" height="50px" alt="avatar" style="border-radius: 50%; margin: 15px">

                            @endif
                            {{ Auth::user()->name }}の価値観日記
                        </a>
                    </div>
                    <!-- メニューボタン -->
                    <div class="uk-navbar-right">
                        <a class="uk-navbar-toggle" uk-navbar-toggle-icon uk-toggle="target: #offcanvas-nav"></a>
                    </div>

                @else
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-item uk-logo" href="/">
                            スタンフォード推奨！価値観日記
                        </a>
                    </div>
                @endauth
            </nav>

            <!-- スマホ環境時のナビバーにあるメニューボタンをタップした際に画面左側からメニュー一覧が出てくる -->
            <div id="offcanvas-nav" uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar">
                    <ul class="uk-nav uk-nav-default">
                        <li>
                            <a href="{{ route('about') }}" >
                                <span class="uk-icon uk-margin-small-right" uk-icon="info"></span>
                                価値観日記とは
                            </a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li>
                            <a href="{{ route('posts.index') }}" >
                                <span class="uk-icon uk-margin-small-right" uk-icon="album"></span>
                                日記
                            </a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li>
                            <a href="{{ route('values.index') }}" >
                                <span class="uk-icon uk-margin-small-right" uk-icon="list"></span>
                                価値観
                            </a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li>
                            <a href="{{ route('graph') }}" >
                                <i class="fa fa-pie-chart fa-lg" aria-hidden="true" ></i>&nbsp;&nbsp;グラフ
                            </a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li>
                            <a href="{{ route('users.show' , [ 'user' => Auth::id() ]) }}">
                                <span class="uk-icon uk-margin-small-right" uk-icon="user"></span>
                                プロフィール
                            </a>
                        </li>
                        <li class="uk-nav-divider"></li>
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
            </div>

            <!-- タブレットとPC環境時のナビバー -->
            <nav class="uk-navbar-container uk-margin-bottom uk-visible@s" uk-navbar>
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
                                    価値観
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('graph') }}" >
                                    <i class="fa fa-pie-chart fa-lg" aria-hidden="true" ></i>&nbsp;&nbsp;グラフ
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.show' , [ 'user' => Auth::id() ]) }}">
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
                            スタンフォード推奨！価値観日記
                        </a>
                    </div>
                @endauth
            </nav>
        </header>
        <main class="py-4">
            @yield('content')
        </main>
        <footer>
            <p class="uk-text-center uk-margin-remove uk-padding-small">&#169; 2019 スタンフォード推奨！価値観日記</p>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>

    @yield('scripts')

    <!-- ページ遷移時にレイアウトが一瞬崩れる現象対策 -->
    <script>
        $(window).on('load', function() {
            $('#app').fadeIn(500);
        });
    </script>


</body>
</html>
