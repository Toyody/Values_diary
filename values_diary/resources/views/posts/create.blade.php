@extends('layouts.app')

@section('content')

  <div class="uk-container">
    <div class="uk-card uk-card-default uk-width-3-5@s uk-align-center">
      <div class="uk-card-body">
        <!-- 戻るボタンをここと編集ページの両方に実装する -->
        <!-- 価値観の編集ページも参考にする -->
        <!-- <div class="uk-align-right">
          <a href="{{ route('posts.index') }}" style="text-decoration: none;">
            <button class="uk-button uk-button-default">
              戻る
            </button>
          </a>
        </div> -->

        @if ($values->count() > 0)
        <form class="uk-form-stacked" action="{{ route('posts.store') }}" method="POST">
            @csrf
            <fieldset class="uk-fieldset">

                <legend class="uk-legend">今日の日記</legend>

                  <div class="uk-margin-medium">
                    <label class="uk-form-label" for="value_tags">価値観（設定済みの価値観から１つ以上を選択）</label>
                    <div class="uk-form-controls">
                      <select class="uk-select tags-selector" id="value_tags" name="value_tags[]" multiple>
                        @foreach ($values as $value)
                          <option value="{{ $value->value }}">
                            {{ $value->value }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                
                  <div class="uk-margin-medium">
                    <label class="uk-form-label" for="actions_for_value">価値観に基づいた行動</label>
                    <div class="uk-form-controls">
                      <textarea class="uk-textarea" rows="5" placeholder="気になっていた本を思い切ってまとめ買いした。" id="actions_for_value" name="actions_for_value"></textarea>
                    </div>
                  </div>

                  <div class="uk-margin-medium">
                      <label class="uk-form-label" for="score">今日の自分は何点？</label>
                      <div class="uk-form-controls">
                          <input class="uk-range" id="score" name="score" type="range" value="2" min="0" max="10" step="0.1">
                      </div>
                  </div>

                  <input class="uk-input uk-button-primary uk-margin" type="submit" value="投稿">

                  <hr>
                  <p>以下は任意</p>
                  <hr>
                  <br>
                  
                  <div class="uk-margin-medium">
                      <label class="uk-form-label" for="good_things">良かったこと（３つ以上が推奨）</label>
                      <div class="uk-form-controls">
                          <textarea class="uk-textarea" rows="5" placeholder="・初めて入った店のご飯が美味しかった&#13;&#10;・仕事に集中できた&#13;&#10;・友達との電話が楽しかった" id="good_things" name="good_things"></textarea>
                      </div>
                  </div>

                  <div class="uk-margin-medium">
                    <label class="uk-form-label" for="troubles">どんなことで悩んでいるのか</label>
                    <div class="uk-form-controls">
                      <textarea class="uk-textarea" rows="5" placeholder="英単語がなかなか覚えられず、このままではTOEICで良い点数が取れるか心配。" id="troubles" name="troubles"></textarea>
                    </div>
                  </div>

                  <div class="uk-margin-medium">
                      <label class="uk-form-label" for="memo">備考欄</label>
                      <div class="uk-form-controls">
                          <textarea class="uk-textarea" rows="5" placeholder="今日はダラダラと寝て過ごしてしまったので罪悪感があった。次からは気分転換に外に出るようにする。" id="memo" name="memo"></textarea>
                      </div>
                  </div>

                  <input class="uk-input uk-button-primary uk-margin" type="submit" value="投稿">
                </fieldset>
              </form>
              @else
                <h3>価値観がありません</h3>
                <strong>まずは価値観を追加しましょう</strong>
              @endif
      </div>
    </div>
  </div>
@endsection

@section('css')

  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

@endsection


@section('scripts')

  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
        $('.tags-selector').select2();
    });
  </script>

@endsection