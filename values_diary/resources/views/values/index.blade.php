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
    <h2 style="display: inline;">価値観一覧</h2>
    <div class="uk-align-right" style="margin: 0;">
      <a href="{{ route('values.create') }}" >
        <button class="uk-button uk-button-primary">
          <span uk-icon="pencil"></span>
          価値観を追加
        </button>
      </a>
    </div>
    {{ $values->links('../pagination.default') }}
    <hr>
    @if ($values->count() > 0)
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
    @else
      <h3 class="uk-text-center">{{ $sentence }}</h3>
    @endif
    <hr>
    {{ $values->links('../pagination.default') }}

    <h2>価値観が分からない場合の参考用</h2>
    <object data="/storage/pdfs/value_card_sort_japanese2.pdf" width="100%" height="650px">
      <p>ご覧の環境では、object要素がサポートされていないようです。<a href="/storage/pdfs/value_card_sort_japanese2.pdf">PDFファイルをダウンロードしてください</a>。</p>
    </object>
    <p>出典：<a href="/storage/pdfs/value_card_sort_japanese2.pdf">ダウンロード（PDF）</a></p>
  </div>
@endsection