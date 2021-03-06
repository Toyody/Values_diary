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
    <div class="uk-card uk-card-default uk-width-1-1 uk-width-3-5@m uk-align-center">
      <div class="uk-card-body">
        <h1 style="display: inline;">プロフィール</h1>
        <div class="uk-align-right@m">
          <a href="{{ route('users.edit', ['user' => $user]) }}" style="text-decoration: none;">
            <button class="uk-button uk-button-default" {{ $user->name === 'Test User' ? 'disabled' : '' }}>
              編集
            </button>
          </a>
        </div>
        @if ($user->name === 'Test User')
          <p class="uk-text-right@m uk-text-meta">※テストユーザーのプロフィールは編集できません</p>
        @endif
        <hr>
        <dl class="uk-description-list uk-description-list-divider uk-text-lead">
            <dt>名前</dt><br>
            <dd>{{ $user->name }}</dd>
            <dt>写真</dt><br>
            @if ($user->profile_image)
              <dd>
                <img src="{{ $user->profile_image }}" width="100px" height="100px" alt="avatar" style="border-radius: 50%;">
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
