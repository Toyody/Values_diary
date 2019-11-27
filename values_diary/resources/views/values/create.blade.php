@extends('layouts.app')

@section('content')

  <div class="uk-container">
    <div class="uk-card uk-card-default uk-width-3-5@s uk-align-center">
      <div class="uk-card-body">
        <form class="uk-form-stacked" action="{{ route('values.store') }}" method="POST">
          @csrf
          <fieldset class="uk-fieldset">

              <legend class="uk-legend">新たな価値観</legend>

              <div class="uk-margin-medium">
                  <label class="uk-form-label" for="value">価値観</label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" placeholder="愛、勇気、思いやり、成長など" id="value" name="value">
                  </div>
              </div>

              <div class="uk-margin-medium">
                  <label class="uk-form-label" for="reason">理由（空欄でもOK）</label>
                  <div class="uk-form-controls">
                      <textarea class="uk-textarea" rows="5" placeholder="学生時代にこういうことで苦しんでいたが、ある人のこんな言葉に救われた。それ以来…" id="reason" name="reason"></textarea>
                  </div>
              </div>
              <input class="uk-input uk-button-primary uk-margin" type="submit" value="追加">
          </fieldset>
        </form>
        <a href="{{ route('values.index') }}" style="text-decoration: none;">
          <button class="uk-input uk-button-default">
            キャンセル
          </button>
        </a>
      </div>
    </div>
  </div>

@endsection