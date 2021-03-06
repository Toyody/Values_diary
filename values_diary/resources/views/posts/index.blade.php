@extends('layouts.app')

@section('content')

  <!-- フラッシュメッセージ -->
  @if (session('flash_message'))
    <div class="flash_message">
      <div class="uk-alert-success" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>{{ session('flash_message') }}</p>
      </div>
    </div>
  @endif

  <div class="uk-container">
    <div class="uk-grid-match">
      <div class="uk-grid">
        <div class="uk-width-2-3@m">
          <h1 style="display: inline;">{{ $title }}</h1>
          @if ($title == 'ゴミ箱')
            @if ($posts->count() > 0)
              <button type="submit" class="uk-button uk-button-danger uk-align-right" uk-toggle="target: #delete_button">空にする
              </button>
              <!-- 削除用モーダル -->
              <div id="delete_button" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                  <strong>ゴミ箱にある日記を完全に消去してもよろしいですか?</strong>
                  <p>この操作は取り消せません。</p>
                  <div class="uk-align-right">
                    <form action="{{ route('trashed-posts.clear') }}" method="POST" style="display: inline">
                      @csrf
                      <button class="uk-button uk-button-default uk-modal-close">キャンセル</button>
                      <button class="uk-button uk-button-danger">
                        削除する
                      </button>
                    </form>
                  </div>
                </div>
              </div>

            @else
                <button type="submit" class="uk-button uk-button-danger uk-align-right" disabled>空にする
                </button>
            @endif
          @else
            <a href="{{ route('posts.create') }}">
              <button class="uk-button uk-button-primary uk-align-right" style="margin: 0;">
                <span uk-icon="file-edit"></span>
                日記を書く
              </button>
            </a>
          @endif
          @if (isset($keyword))
            {{ $posts->appends(['keyword' => $keyword])->links('../pagination.default') }}
          @else
            {{ $posts->links('../pagination.default') }}
          @endif
          <hr>
          @if ($posts->count() > 0)
            <div class="uk-child-width-1-3@m uk-text-center" uk-grid>
              @foreach ($posts as $post)
                <div>
                  <a href="{{ route('posts.show', ['post' => $post]) }}" style="text-decoration: none;">
                    <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                      {{ $post->created_at->format('Y/m/d') }}
                    </div>
                  </a>
                </div>
              @endforeach
            </div>
          @else
            <h2 class="uk-text-center">{{ $sentence }}</h2>
          @endif
          <hr class="uk-margin-bottom">
          @if (isset($keyword))
            {{ $posts->appends(['keyword' => $keyword])->links('../pagination.default') }}
          @else
            {{ $posts->links('../pagination.default') }}
          @endif
        </div>

        <aside class="uk-width-1-3@m">
          <div class="uk-card uk-card-default uk-card-body">
            @if ($title == '日記一覧')
              <a href="{{ route('trashed-posts.index') }}" style="text-decoration: none;">
                <button class="uk-button uk-button-default uk-width-1-1" style="background-color: #e0e0e0;">
                  <span uk-icon="trash"></span>
                  ゴミ箱
                </button>
              </a>
            @else
              <a href="{{ route('posts.index') }}" style="text-decoration: none;">
                <button class="uk-button uk-button-default uk-width-1-1">
                  日記一覧に戻る
                </button>
              </a>
            @endif
          </div>
          <div class="uk-card uk-card-default uk-card-body" style="margin-top: 30px;">

            <div class="uk-card-header">
              <span uk-icon="search"></span>
              <strong>キーワード</strong>
            </div>
            <div class="uk-card-body">
              <form action="{{ route('word-search') }}">
                <input name="keyword" type="text" placeholder="Search..."
                  @if (isset($keyword))
                    {{-- flatpickで日付検索されたときはキーワード検索のvalueに日付が保持されないようにする --}}
                    @if (strpos($keyword, '-') !== false)
                      value=""
                    @else
                      value="{{ $keyword }}"
                    @endif
                  @endif
                >
                <input type="submit" value="検索">
              </form>
            </div>

          </div>

          <div class="uk-card uk-card-default uk-card-body" style="margin-top: 30px;">
            <div class="uk-card-header">
              <span uk-icon="calendar"></span>
              <strong>日付</strong>
            </div>
            <div class="uk-card-body">
              <form action="{{ route('date-search') }}">
                <input class="flatpickr" type="text" placeholder="Select Date.." name="keyword" readonly>
                <input type="submit" value="検索">
              </form>
            </div>
          </div>
          <div class="uk-card uk-card-default uk-card-body" style="margin-top: 30px;">
            <div class="uk-card-header">
              <span uk-icon="tag"></span>
              <strong>価値観</strong>
            </div>
            <div class="uk-card-body">
            @if ($values->count() > 0)
              @foreach ($values as $value)
                <ul style="list-style: none;">
                  <li>
                    <form action="{{ route('value-search') }}">
                      <button type="submit" class="uk-button uk-button-default" value="{{ $value->value }}" name="keyword">{{ $value->value }}</button>
                    </form>
                  </li>
                </ul>
              @endforeach
            @endif
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
@endsection

@section('css')

  <!-- flatpickrのスタイルシート -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!-- flatpickrのブルーテーマの追加スタイルシート -->
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

  <!-- スマホ画面では検索ボタンとテキスト部分が両方とも輪郭がなくなってしまうので対策 -->
  <style>
    @media screen and (max-width: 559px) {
      input[type="submit"], input[type="text"] {
        -webkit-appearance: none;
      }
    }
  </style>

@endsection

@section('scripts')

  <!-- flatpickrのスクリプト -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    flatpickr('.flatpickr');
  </script>

@endsection
