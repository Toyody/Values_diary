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
        <h1 style="display: inline">{{ $post->created_at->format('Y/m/d') }}</h1>
        <div class="uk-align-right">
          <a href="{{ route('posts.index') }}" style="text-decoration: none;">
            <button class="uk-button uk-button-default">
              戻る
            </button>
          </a>
          <a href="{{ route('posts.edit', ['post' => $post]) }}" style="text-decoration: none;">
            <button class="uk-button uk-button-default">
              編集
            </button>
          </a>
          <!-- ゴミ箱アイコン -->
          <a href="">
            <button class="uk-button uk-button-danger" uk-icon="trash">
            </button>
          </a>
        </div>
        
        <hr>
        <dl class="uk-description-list uk-description-list-divider uk-text-lead">
            <dt>価値観</dt><br>
            <dd>{{ $post->value_tag }}</dd>
            <dt>価値観に基づいた行動</dt><br>
            <dd>{{ $post->actions_for_value }}</dd>
            <dt>何点？</dt><br>
            <dd>{{ $post->score }}</dd>
            <dt>良かったこと</dt><br>
            <dd>{{ $post->good_things }}</dd>
            <dt>悩んでいること</dt><br>
            <dd>{{ $post->troubles }}</dd>
            <dt>備考欄</dt><br>
            <dd>{{ $post->memo }}</dd>
        </dl>
        <hr>
        <a href="{{ route('posts.index') }}" style="text-decoration: none;">
          <button class="uk-input uk-button-default">
            戻る
          </button>
        </a>
      </div>
    </div>
  </div>
@endsection