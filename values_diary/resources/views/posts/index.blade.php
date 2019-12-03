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
          <div class="uk-width-2-3">
            <h2 style="display: inline;">{{ $title }}</h2>
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
                    日記投稿
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
            <div class="uk-child-width-1-3 uk-text-center" uk-grid>
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
            <h3 class="uk-text-center">{{ $sentence }}</h3>
          @endif
          <hr>
          @if (isset($keyword))
            {{ $posts->appends(['keyword' => $keyword])->links('../pagination.default') }}
          @else
            {{ $posts->links('../pagination.default') }}
          @endif
        </div>
        <aside class="uk-width-1-3">
          <div class="uk-card uk-card-default uk-card-body">
            <form class="uk-search uk-search-default uk-width-1-1" action="{{ route('search') }}">
              <span uk-search-icon></span>
              <input class="uk-search-input" name="keyword" type="search" placeholder="Search..." value="{{ isset($keyword) ? $keyword : '' }}">
            </form>
          </div>
          <div class="uk-card uk-card-default uk-card-body" style="margin-top: 30px;">
            @if ($title == '投稿一覧')
              <a href="{{ route('trashed-posts.index') }}" style="text-decoration: none;">
                <button class="uk-button uk-button-default uk-width-1-1" style="background-color: #e0e0e0;">
                  <span uk-icon="trash"></span>
                  ゴミ箱
                </button>
              </a>
            @else
              <a href="{{ route('posts.index') }}" style="text-decoration: none;">
                <button class="uk-button uk-button-default uk-width-1-1">
                  投稿一覧に戻る
                </button>
              </a>
            @endif
          </div>
          <div class="uk-card uk-card-default uk-card-body" style="margin-top: 30px; background-color: #d1ffd1;">
            <div class="uk-card-header">
              <span uk-icon="calendar"></span>
              <strong>月間別</strong>
            </div>
            <div class="uk-card-body">
              <p>a</p>
              <p>a</p>
              <p>a</p>
            </div>
          </div>
          <div class="uk-card uk-card-default uk-card-body" style="margin-top: 30px; background-color: #e8ffd1;">
            <div class="uk-card-header">
              <span uk-icon="tag"></span>
              <strong>価値観別</strong>
            </div>
            <div class="uk-card-body">
              <p>a</p>
              <p>a</p>
              <p>a</p>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
@endsection