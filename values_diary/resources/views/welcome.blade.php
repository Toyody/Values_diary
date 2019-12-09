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

    <style>
    .bg_photo {
      background-image: url(/storage/images/diary-968603_1280.jpg);
      background-size: cover;
      background-position: center;
      width: 100vw;
      height: 100vh;
    }
    </style>


</head>
<body>
  @guest
    <div class="bg_photo">
      <div class="uk-container ">
        <div class="uk-card uk-card-default uk-width-3-5 uk-align-center">
          <div class="uk-card-body uk-margin-large-top">
            <div class="uk-card-header">
              <h1 class="uk-card-title uk-text-center">スタンフォード推奨！価値観日記</h1>
            </div>
            <div class="uk-card-body">
              <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="test@example.com">
                <input type="hidden" name="password" value="password">
                <button class="uk-button uk-button-primary uk-width-1-1" type="submit">
                  <span class="uk-icon uk-margin-small-right" uk-icon="check"></span>
                  かんたんログイン（テストユーザー）
                </button>
              </form>
              <div class="uk-child-width-1-2 uk-grid-small uk-text-center uk-margin-small" uk-grid>
                <div>
                  <a href="{{ route('login') }}" style="text-decoration: none;">
                    <button class="uk-button uk-button-default uk-width-1-1">
                      <span class="uk-icon uk-margin-small-right" uk-icon="sign-in"></span>
                      ログイン
                    </button>
                  </a>
                </div>
                <div>
                  <!-- @if (Route::has('register')) -->
                    <a href="{{ route('register') }}">
                      <button class="uk-button uk-button-default uk-width-1-1">
                        <span class="uk-icon uk-margin-small-right" uk-icon="plus"></span>
                        新規登録
                      </button>
                    </a>
                  <!-- @endif -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endguest

</body>
</html>