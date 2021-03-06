@extends('layouts.app')

@section('content')

    <div class="uk-container">
        <div class="uk-card uk-card-default uk-width-3-5@s uk-align-center">
            <div class="uk-card-body">
                <h1 style="display: inline;">日記を書く</h1>
                <div class="uk-align-right@m">
                    <button class="uk-button uk-button-default" id="back">
                      戻る
                    </button>
                </div>

                @if ($values->count() > 0)
                    <hr>
                    <form class="uk-form-stacked" action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <fieldset class="uk-fieldset">

                            <legend class="uk-legend">{{ now()->format('Y/m/d') }}</legend>

                            <div class="uk-margin-medium">
                                <label class="uk-form-label" for="value_tags">価値観（設定済みの価値観から１つ以上を選択）</label>
                                @if($errors->has('value_tags'))
                                    <div class="uk-alert-danger" uk-alert>
                                        @foreach($errors->get('value_tags') as $message)
                                            {{ $message }}<br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="uk-form-controls">
                                    <select class="uk-select tags-selector" id="value_tags" name="value_tags[]" style="width: 100%;" multiple>
                                      @foreach ($values as $value)
                                          <option value="{{ $value->value }}" @if (old('value_tags')) {{ in_array($value->value, old('value_tags')) ? 'selected' : '' }} @endif>
                                            {{ $value->value }}
                                          </option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="uk-margin-medium">
                                <label class="uk-form-label" for="actions_for_value">価値観に基づいた行動</label>
                                @if($errors->has('actions_for_value'))
                                    <div class="uk-alert-danger" uk-alert>
                                        @foreach($errors->get('actions_for_value') as $message)
                                            {{ $message }}<br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" rows="5" placeholder="気になっていた本を思い切ってまとめ買いした。" id="actions_for_value" name="actions_for_value">{{ old('actions_for_value') }}</textarea>
                                </div>
                            </div>

                            <div class="uk-margin-medium">
                                <label class="uk-form-label" for="score">今日の自分は何点？（１０点満点）</label>
                                @if($errors->has('score'))
                                    <div class="uk-alert-danger" uk-alert>
                                        @foreach($errors->get('score') as $message)
                                            {{ $message }}<br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="uk-form-controls">
                                    <input class="uk-range" id="score" name="score" type="range" value="{{ old('score') ? old('score') : '5' }}" min="0" max="10" step="1">
                                    <span id="value">{{ old('score') ? old('score') : '5' }}</span>
                                </div>
                            </div>

                            <input class="uk-input uk-button-primary uk-margin" type="submit" value="投稿">

                            <hr>
                            <p>以下は任意</p>
                            <hr>
                            <br>

                            <div class="uk-margin-medium">
                                <label class="uk-form-label" for="good_things">良かったこと（３つ以上が推奨）</label>
                                @if($errors->has('good_things'))
                                    <div class="uk-alert-danger" uk-alert>
                                        @foreach($errors->get('good_things') as $message)
                                            {{ $message }}<br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" rows="5" placeholder="・初めて入った店のご飯が美味しかった&#13;&#10;・仕事に集中できた&#13;&#10;・友達との電話が楽しかった" id="good_things" name="good_things">{{ old('good_things') }}</textarea>
                                </div>
                            </div>

                            <div class="uk-margin-medium">
                                <label class="uk-form-label" for="troubles">どんなことで悩んでいるのか</label>
                                @if($errors->has('troubles'))
                                    <div class="uk-alert-danger" uk-alert>
                                        @foreach($errors->get('troubles') as $message)
                                            {{ $message }}<br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" rows="5" placeholder="英単語がなかなか覚えられず、このままではTOEICで良い点数が取れるか心配。" id="troubles" name="troubles">{{ old('troubles') }}</textarea>
                                </div>
                            </div>

                            <div class="uk-margin-medium">
                                <label class="uk-form-label" for="memo">備考欄</label>
                                  @if($errors->has('memo'))
                                      <div class="uk-alert-danger" uk-alert>
                                          @foreach($errors->get('memo') as $message)
                                              {{ $message }}<br>
                                          @endforeach
                                      </div>
                                  @endif
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" rows="5" placeholder="今日はダラダラと寝て過ごしてしまったので罪悪感があった。次からは気分転換に外に出るようにする。" id="memo" name="memo">{{ old('memo') }}</textarea>
                                </div>
                            </div>

                            <input class="uk-input uk-button-primary uk-margin" type="submit" value="投稿">
                        </fieldset>
                    </form>
                    <button class="uk-input uk-button-default" id="cancel">
                        キャンセル
                    </button>

                    <!-- 削除用モーダル -->
                    <div id="delete_button" uk-modal>
                        <div class="uk-modal-dialog uk-modal-body">
                            <strong>投稿せずに破棄してもよろしいですか？</strong>
                            <p>この操作は取り消せません</p>
                            <div class="uk-align-right">
                                <button class="uk-button uk-button-default uk-modal-close">キャンセル</button>
                                <a href="{{ route('posts.index') }}" >
                                    <button class="uk-button uk-button-danger">
                                        破棄する
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
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

  <script>
    $(function() {
      // フォームの入力欄が更新されたかどうかを表すフラグ
      var isChanged = false;

      // 戻るボタンかキャンセルボタンがクリックされたとき
      $('#back, #cancel').on("click", function() {
        if (isChanged) {
          // isChangedフラグがtrueの場合、つまり入力内容が変更されていた
          // 場合のみ「変更を破棄しますか」モーダルを表示
          UIkit.modal('#delete_button').show();

        } else {
          // 入力内容が変更されていなければモーダルを表示させずにページ遷移
          window.location.href = "/posts";
        }
      });

      $("form input, form select, form textarea").change(function() {
        // 入力内容が更新されている場合は、isChangedフラグをtrueにする
        isChanged = true;
      });

      $("input[type=submit]").click(function() {
        // フォームをサブミットする前にフラグを落とす
        // ※ これをやらないと、サブミット時にモーダルが表示される
        isChanged = false;
      });
    });
  </script>

  <script>
    let elem = document.getElementById('score');
    let target = document.getElementById('value');
    let rangeValue = function (elem, target) {
      return function(evt){
        target.innerHTML = elem.value;
      }
    }
    elem.addEventListener('input', rangeValue(elem, target));
  </script>

@endsection
