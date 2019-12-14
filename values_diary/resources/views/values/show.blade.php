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
        <h1 style="display: inline;">価値観の詳細</h1>
        <div class="uk-align-right@m">
          <a href="{{ route('values.index') }}" style="text-decoration: none;">
            <button class="uk-button uk-button-default">
              戻る
            </button>
          </a>
          <a href="{{ route('values.edit', ['value' => $value]) }}" style="text-decoration: none;">
            <button class="uk-button uk-button-default">
              編集
            </button>
          </a>
          <button class="uk-button uk-button-danger" uk-toggle="target: #delete_button">削除</button>

          <!-- 削除用モーダル -->
          <div id="delete_button" uk-modal>
            <div class="uk-modal-dialog uk-modal-body">
              <p>本当に削除してもよろしいですか？</p>
              <div class="uk-align-right">
                <form action="{{ route('values.destroy', ['value' => $value]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="uk-button uk-button-default uk-modal-close">キャンセル</button>
                    <button class="uk-button uk-button-danger">
                      削除する
                    </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <dl class="uk-description-list uk-description-list-divider uk-text-lead">
            <dt>価値観</dt><br>
            <dd>{{ $value->value }}</dd>
            <dt>理由</dt><br>
            <dd>{{ $value->reason }}</dd>
        </dl>
      </div>
    </div>
  </div>

@endsection