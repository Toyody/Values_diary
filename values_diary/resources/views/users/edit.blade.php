@extends('layouts.app')

@section('content')

  <div class="uk-container">
    <div class="uk-card uk-card-default uk-width-3-5@s uk-align-center">
      <div class="uk-card-body">
        <h1 style="display: inline">プロフィール</h1>
          <div class="uk-align-right">
            <a href="{{ route('users.show', ['user' => $user]) }}" style="text-decoration: none;">
              <button class="uk-button uk-button-default">
                戻る
              </button>
            </a>
          </div>
        <hr>

        <form class="uk-form-stacked" action="{{ route('users.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <fieldset class="uk-fieldset">

              <legend class="uk-legend">編集</legend>

              <div class="uk-margin-medium">
                  <label class="uk-form-label" for="value">名前</label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" id="name" name="name" value="{{ $user->name }}">
                  </div>
              </div>

              <div class="uk-margin-medium">
                  <label class="uk-form-label" for="profile_image">写真</label>
                  @if ($user->profile_image)
                    <img src="/storage/images/{{ Auth::id() }}.jpg" width="100px" height="100px" alt="avatar" style="border-radius: 50%;">
                    <p>
                      <label class="uk-form-label" for="delete_image"><input class="uk-checkbox" type="checkbox" name="delete_image">現在の写真を削除する</label>
                    </p>
                  @endif
                  <div class="uk-form-controls">
                    <input type="file" id="profile_image" name="profile_image" value="{{ $user->profile_image }}">
                  </div>
              </div>

              <div class="uk-margin-medium">
                  <label class="uk-form-label" for="email">メールアドレス</label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" id="email" name="email" value="{{ $user->email }}">
                  </div>
              </div>

              <div class="uk-margin-medium">
                  <label class="uk-form-label" for="ideal">どんな自分でありたいか</label>
                  <div class="uk-form-controls">
                      <textarea class="uk-textarea" rows="5" id="ideal" name="ideal">{{ $user->ideal }}</textarea>
                  </div>
              </div>
              <input class="uk-input uk-button-primary uk-margin" type="submit" value="編集を確定">
              
            </fieldset>
          </form>
          <a href="{{ route('users.show', ['user' => $user]) }}" style="text-decoration: none;">
            <button class="uk-input uk-button-default">
              キャンセル
            </button>
          </a>
      </div>
    </div>
  </div>

@endsection