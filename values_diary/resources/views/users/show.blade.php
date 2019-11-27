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
    <div class="uk-card uk-card-default uk-width-3-5@s uk-align-center">
      <div class="uk-card-body">
        <h1 style="display: inline;">プロフィール</h1>
        <div class="uk-align-right">
          <a href="{{ route('users.edit', ['user' => $user]) }}" style="text-decoration: none;">
            <button class="uk-button uk-button-default">
              編集
            </button>
          </a>
        </div>
        <hr>
        <dl class="uk-description-list uk-description-list-divider uk-text-lead">
            <dt>名前</dt><br>
            <dd>{{ $user->name }}</dd>
            @if ($user->profile_image)
              <dt>写真</dt><br>
              <dd>
                <img src="/storage/images/{{ Auth::id() }}.jpg" width="100px" height="100px" alt="avatar" style="border-radius: 50%;">
              </dd>
            @endif
            <dt>登録したメールアドレス</dt><br>
            <dd>{{ $user->email }}</dd>
            <dt>どんな自分でありたいか</dt><br>
            <dd>{{ $user->ideal }}</dd>
            <dt>始めた日</dt><br>
            <dd>{{ $user->created_at->format('Y/m/d') }}</dd>
        </dl>
      </div>
    </div>
  </div>
@endsection