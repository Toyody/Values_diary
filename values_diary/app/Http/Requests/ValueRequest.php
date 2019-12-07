<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                'string',
                'max:24',
                Rule::unique('values', 'value')->ignore($exceptId),
            ],
            'reason' => 'string|max:3000',
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
            'value.string' => '価値観は文字列で入力してください',
            'value.max' => '価値観は24文字以内で入力してください',
            'value.unique' => 'すでに同じ価値観が追加されています',
            'reason.string' => '理由は文字列で入力してください',
            'reason.max' => '理由は3000文字以内で入力してください',
        ];
    }
}
