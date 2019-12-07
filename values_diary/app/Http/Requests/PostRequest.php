<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        return [
            'value_tags' => 'required',
            'actions_for_value' => 'required|string|max:3000',
            'score' => 'required|numeric|between:0,10',
            'good_things' => 'string|max:3000',
            'troubles' => 'string|max:3000',
            'memo' => 'max:3000',
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
            'value_tags.required' => '価値観を選択してください',
            'actions_for_value.required' => '価値観に基づいた行動を入力してください',
            'actions_for_value.string' => '価値観に基づいた行動は文字列で入力してください',
            'actions_for_value.max' => '価値観に基づいた行動は3000文字以内で入力してください',
            'score.required' => '今日の自分に点数をつけてください',
            'score.numeric' => '点数は数値で入力してください',
            'score.between' => '点数は0から10以内で入力してください',
            'good_things.string' => '良かったことは文字列で入力してください',
            'good_things.max' => '良かったことは3000文字以内で入力してください',
            'troubles.string' => '悩んでいることは文字列で入力してください',
            'troubles.max' => '悩んでいることは3000文字以内で入力してください',
            'memo.max' => '備考欄は3000文字以内で入力してください',
        ];
    }
}
