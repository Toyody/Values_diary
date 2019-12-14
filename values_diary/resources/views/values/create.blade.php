@extends('layouts.app')

@section('content')

  <div class="uk-container">
    <div class="uk-card uk-card-default uk-width-3-5@s uk-align-center">
      <div class="uk-card-body">
        <h1 style="display: inline;">価値観を追加</h1>
        <div class="uk-align-right@m">
          <button class="uk-button uk-button-default" id="back">
            戻る
          </button>
        </div>
        <hr>

        <form class="uk-form-stacked" action="{{ route('values.store') }}" method="POST">
          @csrf
          <fieldset class="uk-fieldset">

              <legend class="uk-legend">新たな価値観</legend>

              <div class="uk-margin-medium">
                <label class="uk-form-label" for="value">価値観</label>
                @if($errors->has('value'))
                  <div class="uk-alert-danger" uk-alert>
                    @foreach($errors->get('value') as $message)
                      {{ $message }}<br>
                    @endforeach
                  </div>
                @endif 
                <div class="uk-form-controls">
                  <input class="uk-input" type="text" placeholder="愛、勇気、思いやり、成長など" id="value" name="value" value="{{ old('value') }}">
                </div>
              </div>

              <div class="uk-margin-medium">
                <label class="uk-form-label" for="reason">理由（空欄でもOK）</label>
                @if($errors->has('reason'))
                  <div class="uk-alert-danger" uk-alert>
                    @foreach($errors->get('reason') as $message)
                      {{ $message }}<br>
                    @endforeach
                  </div>
                @endif 
                <div class="uk-form-controls">
                  <textarea class="uk-textarea" rows="5" placeholder="学生時代にこういうことで苦しんでいたが、ある人のこんな言葉に救われた。それ以来…" id="reason" name="reason">{{ old('reason') }}</textarea>
                </div>
              </div>
              <input class="uk-input uk-button-primary uk-margin" type="submit" value="追加">
          </fieldset>
        </form>
        <button class="uk-input uk-button-default" id="cancel">
          キャンセル
        </button>

        <!-- 削除用モーダル -->
        <div id="delete_button" uk-modal>
          <div class="uk-modal-dialog uk-modal-body">
            <strong>追加せずに破棄してもよろしいですか？</strong>
            <p>この操作は取り消せません</p>
            <div class="uk-align-right">
              <button class="uk-button uk-button-default uk-modal-close">キャンセル</button>
              <a href="{{ route('values.index') }}" >
                <button class="uk-button uk-button-danger">
                  破棄する
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')

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
          window.location.href = "/values";
        }
      });

      $("form input, form textarea").change(function() {
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

@endsection