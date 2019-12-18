<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // 更新時にuniqueルールで自身と重複しない設定をするために、あらかじめルートパラメーターから自身のidを取得

        // ※userコントローラーでは今のところcreateを使わず、updateでしかバリデーションされないのでそもそもuniqueルールが不要だが将来createを使ったときのためにuniqueルールを記述しておく

        $exceptId = $this->route('user');

        return [
            // Ruleメソッドを使うためパイプではなく配列記法
            'name' => 'required|max:24',
            'profile_image' => 'file|image|mimes:jpeg,png,jpg,gif',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($exceptId),
            ],
            'ideal' => 'max:1000',
        ];
    }

    /**
     * 日本語のエラーメッセージ.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '名前は24文字以内で入力してください',
            'profile_image.file' => '写真にはファイルを指定してください',
            'profile_image.image' => '写真には画像ファイルを指定してください',
            'profile_image.mimes' => '写真にはjpeg,png,jpg,gifのうちいずれかの形式のファイルを指定してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '正しい形式のメールアドレスを入力してください',
            'email.unique' => 'すでに使用されているメールアドレスです',
            'ideal.max' => 'どんな自分でありたいかは1000文字以内で入力してください',
        ];
    }
}
