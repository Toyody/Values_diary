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
        <table class="uk-table uk-table-middle uk-table-divider">
          <thead>
              <tr>
                  <th class="uk-width-small">価値観</th>
                  <th>理由</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($values as $value)
              <tr>
                  <td>{{ $value->value }}</td>
                  <td>{{ $value->reason }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <a href="{{ route('values.create') }}">
    <button class="uk-button uk-button-primary uk-align-center uk-margin-medium-top">
        価値観を追加
    </button>
  </a>
@endsection