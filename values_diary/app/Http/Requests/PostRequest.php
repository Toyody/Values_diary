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
            'actions_for_value' => 'required|max:1000',
            'good_things' => 'max:1000',
            'troubles' => 'max:1000',
            'memo' => 'max:1000',
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
            'actions_for_value.max' => '価値観に基づいた行動は1000文字以内で入力してください',
            'score.required' => '今日の自分に点数をつけてください',
            'score.between' => '点数は0から10以内で入力してください',
            'good_things.max' => '良かったことは1000文字以内で入力してください',
            'troubles.max' => '悩んでいることは1000文字以内で入力してください',
            'memo.max' => '備考欄は1000文字以内で入力してください',
        ];
    }
}
