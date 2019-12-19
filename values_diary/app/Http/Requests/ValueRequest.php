<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class ValueRequest extends FormRequest
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
        $exceptId = $this->route('value');

        return [
            // Ruleメソッドを使うためパイプではなく配列記法
            'value' => [
                'required',
                'max:15',
                Rule::unique('values', 'value')->ignore($exceptId)
                    // ユーザー内で一意になるように条件を追加
                    ->where(function ($query) {
                        return $query->where('user_id', Auth::id());
                    }),
            ],
            'reason' => 'max:1000',
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
            'value.required' => '価値観を入力してください',
            'value.max' => '価値観は15文字以内で入力してください',
            'value.unique' => 'すでに同じ価値観が追加されています',
            'reason.max' => '理由は1000文字以内で入力してください',
        ];
    }
}
