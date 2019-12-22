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

    <!-- ソーシャルログイン用のスタイル -->
    <link href="{{ asset('css/bootstrap-social.css') }}" rel="stylesheet">

    <style>
      .bg_photo {
        background-image: url(https://values-diary-portfolio.s3-ap-northeast-1.amazonaws.com/diary-968603_1280.jpg);
        background-size: cover;
        background-position: center;
        width: 100vw;
        height: 100vh;
      }

      .btn.btn-block.btn-social {
        color: #fff;
      }

      a, a:hover {
        color: black;
      }

      .button-white {
        background-color: #fff;
        opacity: 0.7;
      }
    </style>

</head>
<body>
  @guest
    <div class="bg_photo" id="app">
      <div class="uk-container" style ="z-index: 2;">
        <div class="uk-card uk-card-default uk-width-1-1 uk-width-3-5@m uk-align-center"  style="border-radius: 2%; background-color: rgba(255, 255, 255, 0.7);">
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
              <div class="uk-child-width-1-2@m uk-grid-small uk-text-center uk-margin-small" uk-grid>
                <div>
                  <a href="{{ route('login') }}" style="text-decoration: none;">
                    <button class="uk-button uk-width-1-1@m button-white">
                      <span class="uk-icon uk-margin-small-right" uk-icon="sign-in"></span>
                      ログイン
                    </button>
                  </a>
                </div>
                <div>
                  <a href="{{ route('register') }}">
                    <button class="uk-button uk-width-1-1@m button-white">
                      <span class="uk-icon uk-margin-small-right" uk-icon="plus"></span>
                      新規登録
                    </button>
                  </a>
                </div>
                <div>
                  <a class="btn btn-block btn-social btn-facebook uk-text-center" href="{{ url('login/facebook')}}">
                    <span class="fa fa-facebook"></span> Facebookでログイン
                  </a>
                </div>
                <div>
                  <a class="btn btn-block btn-social btn-google uk-text-center" href="{{ url('login/google')}}">
                    <span class="fa fa-google"></span> Googleでログイン
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    <!-- ログイン済みの場合 -->
    <div class="bg_photo" id="app">
      <div class="uk-container">
        <div class="uk-card uk-card-default uk-width-1-1 uk-width-3-5@m uk-align-center"  style="border-radius: 2%; background-color: rgba(255, 255, 255, 0.7);">
          <div class="uk-card-body uk-margin-large-top">
            <div class="uk-card-header">
              <h1 class="uk-card-title uk-text-center">スタンフォード推奨！価値観日記</h1>
            </div>
            <p class="uk-text-bolder uk-text-center">現在ログイン中です</p>
            <div class="uk-card-body uk-padding-remove-top">
              <a href="{{ route('home') }}">
                <button class="uk-button uk-button-primary uk-width-1-1" type="submit">
                  ホーム画面に戻る
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endguest

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>

</body>
</html>
