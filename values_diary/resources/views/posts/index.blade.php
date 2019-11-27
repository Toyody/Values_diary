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
    <h2>投稿一覧</h2>
    <div class="uk-grid-match">
      <div class="uk-grid">
        <div class="uk-width-2-3">
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
        </div>
        <aside class="uk-width-1-3">
          <div class="uk-card uk-card-default uk-card-body">
            <form class="uk-search uk-search-default">
              <span uk-search-icon></span>
              <input class="uk-search-input" type="search" placeholder="Search...">
            </form>
            <p>a</p>
            <p>a</p>
            <p>a</p>
            <p>a</p>
            <p>a</p>
            <p>a</p>
            <p>a</p>
            <p>a</p>
          </div>
        </aside>
      </div>
    </div>
  </div>
@endsection