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
    <h2 style="display: inline">価値観一覧</h2>
    <div class="uk-align-right">
      <a href="{{ route('values.create') }}">
        <button class="uk-button uk-button-primary">
            価値観を追加
        </button>
      </a>
    </div>
    <hr>
    <div uk-grid="masonry: true">
      <div class="uk-grid">
        <div class="uk-child-width-1-3 uk-text-center" uk-grid>
          @foreach ($values as $value)
            <div>
              <a href="{{ route('values.show', ['value' => $value]) }}" style="text-decoration: none;">
                <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                  <h3 class="uk-card-title">{{ $value->value }}</h3>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <hr>
    {{ $values->links('../pagination.default') }}
  </div>
@endsection