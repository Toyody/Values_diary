@extends('layouts.app')

@section('content')

  <div class="uk-container">
    <div class="uk-card uk-card-default uk-width-3-5@s uk-align-center">
      <div class="uk-card-body">
        <h1 style="display: inline">プロフィール</h1>
          <div class="uk-align-right@m">
            <button class="uk-button uk-button-default" id="back">
              戻る
            </button>
          </div>
        <hr>

        <form class="uk-form-stacked" action="{{ route('users.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <fieldset class="uk-fieldset">

            <legend class="uk-legend">編集</legend>

            <div class="uk-margin-medium">
              <label class="uk-form-label" for="name">名前</label>
              @if($errors->has('name'))
                <div class="uk-alert-danger" uk-alert>
                  @foreach($errors->get('name') as $message)
                    {{ $message }}<br>
                  @endforeach
                </div>
              @endif
              <div class="uk-form-controls">
                <input class="uk-input" type="text" id="name" name="name" value="{{ $user->name }}">
              </div>
            </div>

            <div class="uk-margin-medium">
              <label class="uk-form-label" for="profile_image">写真</label>
              @if ($user->profile_image)
                <img src="{{ $user->profile_image }}" width="100px" height="100px" alt="avatar" style="border-radius: 50%;">
                <p>
                  <label class="uk-form-label" for="delete_image"><input class="uk-checkbox" type="checkbox" name="delete_image">現在の写真を削除する</label>
                </p>
              @endif
              @if($errors->has('profile_image'))
                <div class="uk-alert-danger" uk-alert>
                  @foreach($errors->get('profile_image') as $message)
                    {{ $message }}<br>
                  @endforeach
                </div>
              @endif
              <div class="uk-form-controls">
                <input type="file" id="profile_image" name="profile_image" value="{{ $user->profile_image }}">
              </div>
            </div>

            <div class="uk-margin-medium">
              <label class="uk-form-label" for="email">メールアドレス</label>
              @if($errors->has('email'))
                <div class="uk-alert-danger" uk-alert>
                  @foreach($errors->get('email') as $message)
                    {{ $message }}<br>
                  @endforeach
                </div>
              @endif
              <div class="uk-form-controls">
                <input class="uk-input" type="text" id="email" name="email" value="{{ $user->email }}">
              </div>
            </div>

            <div class="uk-margin-medium">
              <label class="uk-form-label" for="ideal">どんな自分でありたいか（空欄でもOK）</label>
              @if($errors->has('ideal'))
                <div class="uk-alert-danger" uk-alert>
                  @foreach($errors->get('ideal') as $message)
                    {{ $message }}<br>
                  @endforeach
                </div>
              @endif
              <div class="uk-form-controls">
                  <textarea class="uk-textarea" rows="5" id="ideal" name="ideal">{{ $user->ideal }}</textarea>
              </div>
            </div>
            <input class="uk-input uk-button-primary uk-margin" type="submit" value="編集を確定">

          </fieldset>
        </form>
        <button class="uk-input uk-button-default" id="cancel">
          キャンセル
        </button>
        <!-- 削除用モーダル -->
        <div id="delete_button" uk-modal>
          <div class="uk-modal-dialog uk-modal-body">
            <strong>変更を破棄してもよろしいですか？</strong>
            <p>この操作は取り消せません</p>
            <div class="uk-align-right">
              <button class="uk-button uk-button-default uk-modal-close">編集を続ける</button>
              <a href="{{ route('users.show', ['user' => $user]) }}" >
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
            // ページ詳細画面に戻るために「/edit」を削ったURLをあらかじめ生成
            let replacedURL = location.pathname.replace('/edit', '');
            window.location.href = replacedURL;
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
